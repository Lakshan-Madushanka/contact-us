<?php

namespace Lakm\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Event;
use Lakm\Contact\Events\NotifyAdminReplied;
use Lakm\Contact\Events\Replied;
use Lakm\Contact\Http\Requests\ReplyFormRequest;
use Lakm\Contact\Models\Contact;
use Lakm\Contact\Services\UserService;

class ContactReplyController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userServicce = $userService;
    }

    public function create(Contact $contact)
    {
        $repliesCount = $contact->replies()->count();
        $contact['replies_count'] = $repliesCount;

        return view('contact::admins.reply')->with('contact', $contact);
    }

    public function show(Contact $contact)
    {
        $replies = $contact->replies;
        return view('contact::admins.show-replies')->with('replies', $replies);
    }

    public function handleReply(Contact $contact, ReplyFormRequest $request)
    {
        $reply = $request->safe()->only(['subject', 'message']);

        $this->store($contact, $reply);
        $this->notifyAdmins($this->userServicce->getAdmins(), $contact, $reply);
        $this->sendUserReply($contact, $reply);

        $request->session()
            ->flash('successed', 'Your Rreply sent to user successfully !');

        return redirect()->back();
    }

    public function store(Contact $contact, array $request)
    {
        $contact->replies()->create($request);
    }

    public function sendUserReply(Contact $contact, array $reply)
    {
        Event::dispatch(new Replied($contact, $reply));
    }

    public function notifyAdmins($users, Contact $contact, array $reply)
    {
        Event::dispatch(new NotifyAdminReplied($users, $contact, $reply));
    }
}