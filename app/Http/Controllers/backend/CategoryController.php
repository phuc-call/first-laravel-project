<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::select('id', 'image', 'name', 'slug', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Category::where('status', 1)->get();
        return view('backend.category.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = Str::of($request->name)->slug('-');
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $category->slug . '.' . $extension;
            $file->move(public_path("assets/images/category"), $filename);
            $category->image = $filename;
        }
        $category->created_by = Auth::id() ?? 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->status = $request->status;
        $category->sort_order = $request->sort_order;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $category = Category::select(
            'category.id',
            'category.name',
            'category.slug',
            'category.image',
            'category.parent_id',
            'category.sort_order',
            'category.status',
            'category.description',
        )
            ->where('category.id', $id)
            ->first();

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy danh mục');
        }

        return view('backend.Category.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Danh mục không tồn tại!');
        }
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Danh mục không tồn tại!');
        }

        try {
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->slug = Str::of($request->name)->slug('-');
            $category->description = $request->description;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $category->slug . '.' . $extension;
                $file->move(public_path("assets/images/category"), $filename);
                $category->image = $filename;
            }

            $category->created_by = Auth::id() ?? 1;
            $category->created_at = now();
            $category->status = $request->status;
            $category->sort_order = $request->sort_order;
            $category->save();

            return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }
    public function trash()
    {
        $list = Category::select('id', 'image', 'name', 'slug', 'status')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.category.trash', compact('list'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('error', "không tìm thấy thông tin");
        }
        $category->created_by = Auth::id() ?? 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công!');
    }
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('error', "không tìm thấy thông tin");
        }
        $category->created_by = Auth::id() ?? 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->restore();
        return redirect()->route('category.trash')->with('success', 'Khôi phục danh mục thành công!');
    }
    public function delete($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('error', "không tìm thấy thông tin");
        }
        $imagePath = public_path('assets/images/category/' . $category->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $category->forceDelete();
        return redirect()->route('category.trash')->with('success', 'Xóa danh mục thành công!');
    }
    public function status(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        $category->status = $category->status == 1 ? 0 : 1;
        $category->updated_by = Auth::id() ?? 1;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();
        return redirect()->route('category.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
