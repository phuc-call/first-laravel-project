<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreorderRequest;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = order::select('id', 'user_id', 'name', 'phone', 'email', 'address', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.order.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreorderRequest $request)
    {
        $order = new order();
        $order->user_id = $request->user_id;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->status = $request->status;
        $order->address = $request->address;
        $order->save();
        return redirect()->route('order.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::select('id', 'user_id', 'name', 'phone', 'email', 'address', 'status')
            ->where('order.id', $id)
            ->first();
        if (!$order) {
            return redirect('order.index')->with('error', 'không tìm thấy thông tin.');
        }
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = order::find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy đơn hàng!');
        }
        return view('backend.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = order::find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy đơn hàng!');
        }
        try {
            $order->user_id = $request->user_id;
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->status = $request->status;
            $order->address = $request->address;
            $order->save();
            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật đơn hàng thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $list = order::select('id', 'user_id', 'name', 'phone', 'email', 'address', 'status')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.order.trash', compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $order->create_by = Auth::id() ?? 1;
        $order->created_at = date('Y-m-d H:i:s');
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function restore($id)
    {
        $order = Order::onlyTrashed()->find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $order->restore();
        return redirect()->route('order.index')->with('success', 'Khôi phục thương hiệu thành công!');
    }
    public function delete($id)
    {
        $order = Order::onlyTrashed()->find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $order->forceDelete();
        return redirect()->route('order.trash')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function status(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('order.index')->with('error', "không tìm thấy thông tin");
        }
        $order->status = $order->status == 1 ? 0 : 1;
        $order->save();
        return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái thành công!');
    }
}
