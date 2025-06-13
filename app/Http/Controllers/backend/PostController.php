<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\StorPostRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Post::select('id', 'title', 'detail', 'slug', 'thumbnail', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.post.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Post::where('status', 1)->get();
        return view('backend.post.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorPostRequests $request)
    {
        $post = new post();
        $post->title = $request->title;
        $post->detail = $request->detail;

        $post->slug = str_replace(' ', '-', $post->title);
        $post->description = $request->description;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;
            $file->move(public_path("assets/thumbnail/post"), $filename);
            $post->thumbnail = $filename;
        }
        $post->created_by = Auth::id() ?? 1;
        $post->created_at = date('Y-m-d H:i:s');
        $post->status = $request->status;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::select('id', 'thumbnail', 'title', 'slug', 'description', 'status')
            ->where('id', $id)
            ->first();
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Không tìm thấy bài viết!');
        }
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Không tìm thấy bài viết!');
        }
        return view('backend.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'không tìm thấy bài viết');
        }
        try {
            $post->title = $request->title;
            $post->detail = $request->detail;

            $post->slug = str_replace(' ', '-', $post->title);
            $post->description = $request->description;

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = $post->slug . '.' . $extension;
                $file->move(public_path("assets/thumbnail/post"), $filename);
                $post->thumbnail = $filename;
            }
            $post->created_by = Auth::id() ?? 1;
            $post->created_at = date('Y-m-d H:i:s');
            $post->status = $request->status;
            $post->save();
            return redirect()->route('post.index')->with('success', 'Thêm danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->route('post.edit', ['post' => $id])->with('error', 'Cập nhật không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Không tìm thấy bài viết!');
        }
        $post->create_by = Auth::id() ?? 1;
        $post->created_at = date('Y-m-d H:i:s');
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Xóa bài viết thành công!');
    }
    public function trash()
    {
        $list = Post::select('id', 'thumbnail', 'title', 'slug', 'status')
            ->orderBy('created_at', 'desc')
            ->onlyTrashed()
            ->paginate(5);
        return view('backend.post.trash', compact('list'));
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if (!$post) {
            return redirect()->route('post.trash')->with('error', 'Không tìm thấy bài viết!');
        }
        $post->created_by = Auth::id() ?? 1;
        $post->created_at = date('Y-m-d H:i:s');
        $post->restore();
        return redirect()->route('post.trash')->with('success', 'Khôi phục bài viết thành công!');
    }
    public function delete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if (!$post) {
            return redirect()->route('post.trash')->with('error', 'Không tìm thấy bài viết!');
        }
        if ($post->thumbnail) {
            $path_delete = public_path('assets/thumbnail/post/' . $post->thumbnail);
            if (File::exists($path_delete)) {
                File::delete($path_delete);
            }
        }
        $post->forceDelete();
        return redirect()->route('post.trash')->with('success', 'Xóa bài viết thành công!');
    }
    public function status(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('product.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        $post->status = $post->status == 1 ? 0 : 1;
        $post->updated_by = Auth::id() ?? 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();
        return redirect()->route('post.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
