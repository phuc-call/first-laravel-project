<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Contact::select('id', 'user_id', 'name', 'email', 'phone', 'title', 'content', 'reply_id', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.contact.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Contact::where('status', 1)->get();
        return view('backend.contact.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->user_id = $request->user_id;
        $contact->email = $request->email;
        $contact->created_by = Auth::id() ?? 1;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->status = $request->status;
        $contact->phone = $request->phone;
        $contact->content = $request->content;
        $contact->title = $request->title;

        $contact->save();
        return redirect()->route('frontend.contact')->with('success', 'Đã gửi!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $contact = Contact::select(
            'id',
            'user_id',
            'name',
            'email',
            'phone',
            'title',
            'content',
            'reply_id',
            'status'
        )
            ->where('contact.id', $id)
            ->first();

        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'Không tìm thấy danh mục');
        }

        return view('backend.contact.show', compact('contact'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'Danh mục không tồn tại!');
        }
        return view('backend.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'Danh mục không tồn tại!');
        }

        try {
            $contact->name = $request->name;
            $contact->user_id = $request->user_id;
            $contact->email = $request->email;
            $contact->created_by = Auth::id() ?? 1;
            $contact->created_at = date('Y-m-d H:i:s');
            $contact->status = $request->status;
            $contact->phone = $request->phone;
            $contact->content = $request->content;
            $contact->title = $request->title;

            $contact->save();

            return redirect()->route('contact.index')->with('success', 'Thêm danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }
    public function trash()
    {
        $list = contact::select('id', 'user_id', 'name', 'email', 'phone', 'title', 'content', 'reply_id', 'status')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.contact.trash', compact('list'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('contact.index')->with('error', "không tìm thấy thông tin");
        }
        $contact->created_by = Auth::id() ?? 1;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'Xóa danh mục thành công!');
    }
    public function restore($id)
    {
        $contact = Contact::withTrashed()->find($id);
        if ($contact == null) {
            return redirect()->route('contact.index')->with('error', "không tìm thấy thông tin");
        }
        $contact->created_by = Auth::id() ?? 1;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->restore();
        return redirect()->route('contact.trash')->with('success', 'Khôi phục danh mục thành công!');
    }
    public function delete($id)
    {
        $contact = Contact::withTrashed()->find($id);
        if ($contact == null) {
            return redirect()->route('contact.index')->with('error', "không tìm thấy thông tin");
        }
        $imagePath = public_path('assets/images/contact/' . $contact->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $contact->forceDelete();
        return redirect()->route('contact.trash')->with('success', 'Xóa danh mục thành công!');
    }
    public function status(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('contact.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        $contact->status = $contact->status == 1 ? 0 : 1;
        $contact->updated_by = Auth::id() ?? 1;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->save();
        return redirect()->route('contact.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
