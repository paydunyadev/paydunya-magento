<?php

namespace App\Http\Controllers;

use App\Events\NewContact;
use App\Http\Requests\ContactStoreRequest;
use App\Jobs\SyncMedia;
use App\Models\User;
use App\Notification\ReviewNotification;
use App\app\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::all();

        return view('contact.index', compact('contacts'));
    }

    /**
     * @param \App\Http\Requests\ContactStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->validated());
        $user = User::where('profile_id',1);
        Notification::send($user, new ReviewNotification($contact));

        SyncMedia::dispatch($contact);

        event(new NewContact($contact));

        $request->session()->flash('contact.name', $contact->name);

        return redirect()->route('contact.index');
    }
}
