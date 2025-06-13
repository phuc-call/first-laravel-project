<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $list = Topic::select('id', 'name', 'slug', 'status', 'description')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.topic.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Topic::where('status', 1)->get();
        return view('backend.topic.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new topic();
        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->created_by = Auth::id() ?? 1;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->status = $request->status;
        $topic->save();
        return redirect()->route('topic.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::select('id', 'name', 'slug', 'status', 'description')
            ->where('topic.id', $id)
            ->first();

        if (!$topic) {
            return redirect()->route('topic.index')->with('error', 'Không tìm thấy danh mục');
        }

        return view('backend.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::find($id);
        if (!empty($topic)) {
            return view('backend.topic.edit', compact('topic'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            return redirect()->route('topic.index')->with('error', 'Không tìm thấy danh mục.');
        }
        try {
            $topic->name = $request->name;
            $topic->description = $request->description;
            $topic->slug = Str::of($request->name)->slug('-');
            $topic->created_by = Auth::id() ?? 1;
            $topic->created_at = date('Y-m-d H:i:s');
            $topic->status = $request->status;
            $topic->save();
            return redirect()->route('topic.index')->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            // Thông báo thất bại
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại. Vui lòng thử lại!');
        }
    }
    public function trash()
    {
        $list = Topic::select('id', 'name', 'slug', 'status', 'description')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.topic.trash', compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('topic.index')->with('error', "không tìm thấy thông tin");
        }
        $topic->created_by = Auth::id() ?? 1;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->delete();
        return redirect()->route('topic.index')->with('success', 'Xóa danh mục thành công!');
    }
    public function restore($id)
    {
        $topic = Topic::withTrashed()->find($id);
        if ($topic == null) {
            return redirect()->route('topic.index')->with('error', "không tìm thấy thông tin");
        }
        $topic->created_by = Auth::id() ?? 1;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->restore();
        return redirect()->route('topic.trash')->with('success', 'Khôi phục danh mục thành công!');
    }
    public function delete($id)
    {
        $topic = Topic::withTrashed()->find($id);
        if ($topic == null) {
            return redirect()->route('topic.index')->with('error', "không tìm thấy thông tin");
        }
        $imagePath = public_path('assets/images/topic/' . $topic->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $topic->forceDelete();
        return redirect()->route('topic.trash')->with('success', 'Xóa danh mục thành công!');
    }
    public function status(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('topic.index')->with('error', 'Không tìm thấy sản phẩm');
        }
        $topic->status = $topic->status == 1 ? 0 : 1;
        $topic->updated_by = Auth::id() ?? 1;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->save();
        return redirect()->route('topic.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
