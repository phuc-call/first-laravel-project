<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\StoreMenuRequest;
use App\Models\menu;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Termwind\style;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = menu::select('id', 'link', 'parent_id', 'sort_order', 'name', 'status', 'type', 'link')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.menu.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = menu::where('status', 1)->get();
        return view('backend.menu.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {

        $menu = new menu();
        $menu->link = Str::of($request->link)->slug('-');
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->type = $request->type;
        $menu->created_by = Auth::id() ?? 1;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->status = $request->status;
        $menu->sort_order = $request->sort_order;
        $menu->save();
        return redirect()->route('menu.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::select('id', 'link', 'parent_id', 'sort_order', 'name', 'status', 'type')
            ->where('menu.id', $id)
            ->first();
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        return view('backend.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy menu.');
        }
        return view('backend.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy danh mục');
        }
        try {
            $menu->link = Str::of($request->link)->slug('-');
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->type = $request->type;
            $menu->created_by = Auth::id() ?? 1;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->status = $request->status;
            $menu->sort_order = $request->sort_order;
            $menu->save();
            return redirect()->route('menu.index')->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $list = Menu::select('id', 'link', 'parent_id', 'sort_order', 'name', 'status', 'type', 'link')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.menu.trash', compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $menu->create_by = Auth::id() ?? 1;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function restore($id)
    {
        $menu = Menu::onlyTrashed()->find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $menu->created_by = Auth::id() ?? 1;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->restore();
        return redirect()->route('menu.index')->with('success', 'Khôi phục thương hiệu thành công!');
    }
    public function delete($id)
    {
        $menu = Menu::onlyTrashed()->find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $menu->forceDelete();
        return redirect()->route('menu.trash')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function status(string $id)
    {
        $category = Menu::find($id);
        if ($category == null) {
            return redirect()->route('menu.index')->with('error', "không tìm thấy thông tin");
        }
        $category->status = $category->status == 1 ? 0 : 1;
        $category->created_by = Auth::id() ?? 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->save();
        return redirect()->route('menu.index')->with('success', 'Cập nhật trạng thái thành công!');
    }
}
