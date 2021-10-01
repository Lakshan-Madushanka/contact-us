<?php

namespace Lakm\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lakm\Contact\Events\UserInqured;
use Lakm\Contact\Http\Requests\ContactFormRequest;
use Lakm\Contact\Models\Contact;
use Lakm\Contact\Models\Reply;
use Lakm\Contact\Services\UserService;

class ContactController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function view()
    {
        return view('contact::contact');
    }

    public function index()
    {
        $contacts = $this->loadData();

        return view('contact::admins.all-contacts')->with('contacts',
            $contacts);
    }

    public function send(ContactFormRequest $request)
    {
        $inquery = Contact::create($request->validated());

        if ($inquery) {
            $users = $this->userService->getAdmins();
            UserInqured::dispatch($inquery, $users);
        }

        $request->session()
            ->flash('successed', 'Your Inquery sent to admin successfully !');

        return redirect()->back();
    }

    public function show($userEmail)
    {
        $inqueries = Contact::withCount('replies')->where('email', $userEmail)
            ->orderByDesc('id')->get();

        return view('contact::admins.contacts')->with('inqueries', $inqueries);
    }

    public function showById($contact)
    {
        $contact = Contact::where('id', $contact)->get();

        return view('contact::admins.contacts')->with('inqueries', $contact);

    }

    public function search(Request $request)
    {
        $seacrhText = $request->search;

        $contacts = $this->loadData()->where('email', '=', $seacrhText);

        if(count($contacts) === 0) {
            $contacts = $this->loadData()->where('contact_number', '=', $seacrhText);
        }
        if(count($contacts) === 0){
            $contacts = $this->loadData()->where('name', '=', $seacrhText);
        }

        return view('contact::admins.all-contacts')->with('contacts',
            $contacts);
    }

    public function filterData(Request $request)
    {
        $contacts = $this->loadData();

        if ($request->query('answered') === 'true') {
            $contacts = $contacts->where('not_answered', '=', 0);
        }

        if ($request->query('date_asc') === 'true') {
            $contacts = $contacts->sort()->values();
        }

        if ($request->query('last_replied') === 'true') {
            $contacts->each(function ($contact) {
                $reply = Reply::whereHas('contact',
                    function ($query) use ($contact) {
                        $query->where('email', $contact->email);
                    })->orderByDesc('id')->first();
                $contact['last_reply'] = optional($reply)->id;
            });

            $contacts = $contacts->sortByDesc('last_reply')->values();

        }

        if ($request->query('not_answered') === 'true') {
            $contacts = $contacts->where('not_answered', '>', 0);
        }

        return response()->json($contacts, 201);

        return view('contact::admins.all-contacts')->with('contacts',
            $contacts);
    }

    public function loadData()
    {
        DB::statement("SET sql_mode = ''");
        try {
            $contacts = Contact::select('id', 'name', 'email', 'contact_number',
                DB::raw("count('*') as num_of_inqueries"))
                ->groupBy('email')
                ->get();

            $contacts = $contacts->each(function ($contact) {
                $cnt  = Contact::where('email', $contact->email)
                         ->withCount('replies')->get();

                $notAnswered = $cnt->where('replies_count', 0)->count();

                $contact['created_at'] = $cnt->sortByDesc('id')
                    ->pluck('created_at')->first();//->value('created_at');

                $contact['replies_count']
                                         = count($cnt->pluck('replies_count'));
                $contact['not_answered'] = $notAnswered;

            });

        } catch (\Exception $exception) {
            DB::statement("SET sql_mode = 'STRICT_TRANS_TABLES'");
            throw $exception;
        }
        DB::statement("SET sql_mode = 'STRICT_TRANS_TABLES'");

        return $contacts;
    }

    public function deleteById(Contact $contact)
    {
        echo 'eeeeee';
        //  dd();
        $contact->delete();

        return redirect()->back();
    }

    public function deleteByEmail($contactEmail)
    {
        Contact::where('email', $contactEmail)->delete();

        return redirect()->back();
    }


    public function deleteManyByEmail(Request $request)
    {
        $emails = Contact::whereIn('id', $request->ids)->pluck('email');
return $request->ids;
        Contact::whereIn('email', $emails)->delete();
    }

    public function deleteManyById()
    {
        Contact::destroy(\request()->ids);
    }


}