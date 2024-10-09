<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        // جلب جميع الرسائل
        $messages = ContactUs::all();
        return view('dashboard.contact_us', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // إنشاء الرسالة
        ContactUs::create($validated);

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }

    public function update(Request $request, ContactUs $contact)
    {
        // تحديث حالة الرسالة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الرسالة بنجاح.');
    }

    public function destroy(ContactUs $contact)
    {
        $contact->delete();
        return redirect()->route('contact_us.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }
}
