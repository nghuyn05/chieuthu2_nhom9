<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ReplyContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contact.contact-list', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 1]);

        return view('admin.contact.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return back()->with('success', 'Đã xóa liên hệ');
    }
    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.reply', compact('contact'));
    }

    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);

        Mail::to($contact->email)->send(new ReplyContactMail($request->reply));

        return redirect()->route('admin.contact.index')->with('success', 'Đã gửi phản hồi thành công!');
    }

}
