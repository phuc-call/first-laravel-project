<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Banner::select('id', 'image', 'name', 'description', 'status', 'sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.banner.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {

        $banner = new banner();
        $banner->name = $request->name;
        $banner->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($request->name) . '-' . time(); // tạo slug riêng
            $filename = $slug . '.' . $extension;
            $file->move(public_path("assets/images/banner"), $filename);
            $banner->image = $filename;
        }
        $banner->created_by = Auth::id() ?? 1;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->status = $request->status;
        $banner->sort_order = $request->sort_order;
        $banner->save();
        return redirect()->route('banner.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::select('id', 'image', 'name', 'description', 'status', 'sort_order')
            ->where('id', $id)
            ->first();
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        return view('backend.banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Không tìm thấy danh mục!');
        }
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Không tìm thấy danh mục!');
        }
        try {
            $banner->name = $request->name;
            $banner->description = $request->description;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $slug = Str::slug($request->name) . '-' . time(); // tạo slug riêng
                $filename = $slug . '.' . $extension;
                $file->move(public_path("assets/images/banner"), $filename);
                $banner->image = $filename;
            }
            $banner->created_by = Auth::id() ?? 1;
            $banner->created_at = date('Y-m-d H:i:s');
            $banner->status = $request->status;
            $banner->sort_order = $request->sort_order;
            $banner->save();
            return redirect()->route('banner.index')->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật danh mục thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('banner.index')->with('error', 'không tìm thấy thông tin');
        }
        $banner->created_by = Auth::id() ?? 1;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Xóa danh mục thành công!');
    }
    public function trash()
    {
        $list = Banner::select('id', 'image', 'name', 'description', 'status', 'sort_order')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.banner.trash', compact('list'));
    }
    public function delete($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if ($banner == null) {
            return redirect()->route('banner.index')->with('error', 'không tìm thấy thông tim');
        }
        $path = public_path('assets/images/banner/' . $banner->image);
        if (File::exists($path)) {
            File::delete($path);
        }

        $banner->forceDelete();
        return redirect()->route('banner.trash')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function status(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('banner.index')->with('error', "không tìm thấy thông tin");
        }
        $banner->status = $banner->status == 1 ? 0 : 1;
        $banner->created_by = Auth::id() ?? 1;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->save();
        return redirect()->route('banner.index')->with('success', 'Cập nhật trạng thái thành công!');
    }
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $banner->created_by = Auth::id() ?? 1;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->restore();
        return redirect()->route('banner.trash')->with('success', 'Khôi phục thương hiệu thành công!');
    }
}
