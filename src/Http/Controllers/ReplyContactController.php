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

class ReplyContactController extends Controller
{
    public function show(Contact $contact)
    {
        return view('contact::admins.show-replies')->with('replies', $contact);
    }
}