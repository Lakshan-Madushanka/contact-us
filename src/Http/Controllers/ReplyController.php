<?php


namespace Lakm\Contact\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lakm\Contact\Models\Contact;
use Lakm\Contact\Models\Reply;

class ReplyController extends Controller
{
    public function index()
    {
        $replies = Reply::orderByDesc('id')->get();

        return view('contact::admins.all-replies')->with('replies', $replies);
    }

    public function destroy($reply, Request $request)
    {
        print_r($reply);
        //dd();
       // Contact::destroy($request->ids ? $request->ids : [$reply]);
        $reply->delete();

        $request->session()->flash('successed', 'Record Deleted Successfully');

        return redirect()->back();
    }

    public function destroyMany(Request $request)
    {
        //print_r($reply);
        //dd();
        Reply::destroy($request->ids);
        //$reply->delete();

       // $request->session()->flash('successed', 'Record Deleted Successfully');

       // return redirect()->back();
    }

}