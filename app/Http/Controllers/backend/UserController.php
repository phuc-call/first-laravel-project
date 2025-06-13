<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = User::select('id', 'name', 'email', 'phone', 'username', 'password', 'address', 'avatar', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.user.index', compact('list'));
    }
    public function trash()
    {
        $list = User::select('id', 'name', 'email', 'phone', 'username', 'password', 'address', 'avatar', 'status')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.user.trash', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = User::where('status', 1)->get();
        return view('backend.user.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->slug . '.' . $extension;
            $file->move(public_path('assets/images/user'), $filename);
            $user->avatar = $filename;
        }
        $user->created_by = Auth::id() ?? 1;
        $user->created_at = date('Y-m-d H:i:s');
        $user->status = $request->status;
        $user->save();
        return redirect()->route('user.index')->with('thongbao', 'thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::select('id', 'name', 'email', 'phone', 'username', 'password', 'address', 'avatar', 'status')
            ->where('user.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Không tìm thấy danh mục');
        }

        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return view('backend.user.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Không tìm thấy danh mục.');
        }
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->address = $request->address;
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $filename = $user->slug . '.' . $extension;
                $file->move(public_path('assets/images/user'), $filename);
                $user->avatar = $filename;
            }
            $user->created_by = Auth::id() ?? 1;
            $user->created_at = date('Y-m-d H:i:s');
            $user->status = $request->status;
            $user->save();
            return redirect()->route('user.index')->with('thongbao', 'thanh cong');
        } catch (\Exception $e) {
            // Thông báo thất bại
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('user.index')->with('error', "không tìm thấy thông tin");
        }
        $user->created_by = Auth::id() ?? 1;
        $user->created_at = date('Y-m-d H:i:s');
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Xóa danh mục thành công!');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user == null) {
            return redirect()->route('user.index')->with('error', "không tìm thấy thông tin");
        }
        $user->created_by = Auth::id() ?? 1;
        $user->created_at = date('Y-m-d H:i:s');
        $user->restore();
        return redirect()->route('user.trash')->with('success', 'Khôi phục danh mục thành công!');
    }
    public function delete($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user == null) {
            return redirect()->route('user.index')->with('error', "không tìm thấy thông tin");
        }
        $imagePath = public_path('assets/images/user/' . $user->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $user->forceDelete();
        return redirect()->route('user.trash')->with('success', 'Xóa danh mục thành công!');
    }
        public function status(string $id)
        {
            $user = User::find($id);
            if ($user == null) {
                return redirect()->route('user.index')->with('error', 'Không tìm thấy sản phẩm');
            }
            $user->status = $user->status == 1 ? 0 : 1;
            $user->updated_by = Auth::id() ?? 1;
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
            return redirect()->route('user.index')->with('success', 'Cập nhật trạng thái thành công');
        }
    }
