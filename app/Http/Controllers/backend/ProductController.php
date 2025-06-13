<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::select(
            'product.id',
            'thumbnail',
            'product.name',
            'category.name as categoryname',
            'brand.name as brandname',
            'product.status',
            'product.qty',

        )
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->Orderby('product.created_at', 'desc')
            ->paginate(5);
        return view('backend.product.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        return view('backend.product.create', compact('list_category', 'list_brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');

        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->price_sale = $request->price_sale;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $product->slug . '.' . $extension;
            $file->move(public_path('assets/images/product'), $filename);
            $product->thumbnail = $filename;
        }

        $product->created_by = Auth::id() ?? 1;
        $product->created_at = date('Y-m-d H:i:s');
        $product->status = $request->status;
        $product->save();
        return redirect()->route('product.index')->with('thongbao', 'thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::select(
            'product.id',
            'product.name',
            'product.slug',
            'product.thumbnail',
            'product.price_root',
            'product.price_sale',
            'product.qty',
            'product.description',
            'product.detail',
            'category.name as categoryname',
            'brand.name as brandname'
        )
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->where('product.id', $id)
            ->first();

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        return view('backend.product.product-detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('error', 'Không tìm thấy thông tin');
        }
        $list_category = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        return view('backend.product.edit', compact('list_category', 'list_brand', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('error', "không tìm thấy thông tin");
        }
        try {
            $product->name = $request->name;
            $product->slug = Str::of($request->name)->slug('-');
            $product->detail =  $request->detail;
            $product->description = $request->description;
            $product->price_root = $request->price_root;
            $product->price_sale = $request->price_sale;
            $product->qty = $request->qty;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                // xóa hình cũ
                $path_delete = public_path('assets/images/product/' . $product->exif_thumbnail);
                if (File::exists($path_delete)) {
                    File::delete($path_delete);
                }
                $extension = $file->getClientOriginalExtension();
                $filename = $product->slug . '.' . $extension;
                $file->move(public_path('assets/images/product'), $filename);
                $product->thumbnail = $filename;
            }
            $product->updated_by = Auth::id() ?? 1;
            $product->updated_at = date('Y-m-d H:i:s');
            $product->status = $request->status;
            $product->save();
            return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            // Thông báo thất bại
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $list = Product::select('product.id', 'thumbnail', 'product.name', 'category.name as categoryname', 'brand.name as brandname', 'product.status')
            ->onlyTrashed()
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->Orderby('product.created_at', 'desc')
            ->paginate(5);
        return view('backend.product.trash', ['list' => $list]);
    }
    public function restore(string $id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product == null) {
            return redirect()->route('product.trash')->with('error', 'không tìm thấy thông tin');
        }
        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->restore();
        return redirect()->route('product.trash')->with('success', 'khôi phục thành công');
    }
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->delete(); // Sử dụng soft delete

        return redirect()->route('product.index')->with('success', 'Đã chuyển vào thùng rác');
    }
    //table delete
    public function delete(string $id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product == null) {
            return redirect()->route('product.trash')->with('error', 'Không tìm thấy sản phẩm');
        }
        //xóa hình nếu có
        $path_delete = public_path('assets/images/product/' . $product->thumbnail);
        if (File::exists($path_delete)) {
            File::delete($path_delete);
        }
        $product->forceDelete();
        return redirect()->route('product.trash')->with('success', 'Đã xóa sản phẩm vĩnh viễn');
    }
    //status
    public function status(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        $product->status = $product->status == 1 ? 0 : 1;
        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();
        return redirect()->route('product.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
