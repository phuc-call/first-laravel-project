<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Brand::select('id', 'image', 'name', 'slug', 'status', 'sort_order', 'description')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.brand.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->slug = Str::of($request->name)->slug('-');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $brand->slug . '.' . $extension;
            $file->move(public_path("assets/images/brand"), $filename);
            $brand->image = $filename;
        }
        $brand->created_by = Auth::id() ?? 1;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->status = $request->status;
        $brand->sort_order = $request->sort_order;
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand=Brand::select('id', 'image', 'name', 'slug', 'status', 'sort_order', 'description')
            ->where('id',$id)
            ->first();
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        return view('backend.brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }

        try {
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->slug = Str::of($request->name)->slug('-');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $brand->slug . '.' . $extension;
                $file->move(public_path("assets/images/brand"), $filename);
                $brand->image = $filename;
            }
            $brand->status = $request->status;
            $brand->sort_order = $request->sort_order;
            $brand->save();
            return redirect()->route('brand.index')->with('success', 'Cập nhật thương hiệu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }
    public function trash()
    {
        $list = Brand::select('id', 'image', 'name', 'slug', 'status', 'sort_order', 'description')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.brand.trash', compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $brand->create_by = Auth::id() ?? 1;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $brand->created_by = Auth::id() ?? 1;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->restore();
        return redirect()->route('brand.index')->with('success', 'Khôi phục thương hiệu thành công!');
    }
    public function delete($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
        $path = public_path('assets/images/brand/' . $brand->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $brand->forceDelete();
        return redirect()->route('brand.trash')->with('success', 'Xóa thương hiệu thành công!');
    }
    public function status(string $id)
    {
        $category = Brand::find($id);
        if ($category == null) {
            return redirect()->route('brand.index')->with('error', "không tìm thấy thông tin");
        }
        $category->status = $category->status == 1 ? 0 : 1;
        $category->created_by = Auth::id() ?? 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->save();
        return redirect()->route('brand.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

}
