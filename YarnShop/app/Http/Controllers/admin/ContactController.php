<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // 🔹 Lấy danh sách liên hệ (API + WEB)
    public function index(Request $request)
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        // Nếu gọi từ API → trả JSON
        if ($request->expectsJson()) {
            return response()->json([
                'trang_thai' => 'thành công',
                'du_lieu' => $contacts
            ]);
        }

        // WEB
        return view('admin.contact.contact-list', compact('contacts'));
    }

    // 🔹 Xem chi tiết liên hệ
    public function show(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 1]); // đánh dấu đã đọc

        if ($request->expectsJson()) {
            return response()->json([
                'trang_thai' => 'thành công',
                'du_lieu' => $contact
            ]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    // 🔹 Xóa liên hệ
    public function destroy(Request $request, $id)
    {
        Contact::destroy($id);

        if ($request->expectsJson()) {
            return response()->json([
                'trang_thai' => 'thành công',
                'thong_bao' => 'Đã xóa liên hệ'
            ]);
        }

        return back()->with('success', 'Đã xóa liên hệ');
    }

    // 🔹 Hiển thị form trả lời (WEB)
    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.reply', compact('contact'));
    }

    // 🔹 Gửi phản hồi (KHÔNG dùng email nữa)
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);

        // ✅ Lưu phản hồi vào database kèm thời gian phản hồi
        $contact->update([
            'reply' => $request->reply,
            'status' => 2, // đã phản hồi
            'replied_at' => now(), // dòng này để ghi thời gian trả lời
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Đã phản hồi thành công!');
    }

    // 🔹 Tạo liên hệ mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $customer = session('customer');

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 0, // chưa đọc
            'customer' => $customer['id'] ?? null
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'trang_thai' => 'thành công',
                'thong_bao' => 'Gửi liên hệ thành công',
                'du_lieu' => $contact
            ], 201);
        }

        return back()->with('success', 'Gửi liên hệ thành công!');
    }
}