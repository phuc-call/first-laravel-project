<x-layout--admin>
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('post.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>
        <div class="infomation">
            <div>
                @if (!empty($post->thumbnail))
                    <img src="{{ asset('assets/thumbnail/post/' . $post->thumbnail) }}" alt=""
                        class="w-20 h-20 object-cover rounded">
                @else
                    <p>không có ảnh</p>
                @endif
                <p><strong>Id:</strong> {{ $post->id }}</p>
                <p><strong>Title:</strong> {{ $post->title }}</p>
                <p><strong>Slug:</strong> {{ $post->slug }}</p>
                <p><strong>Description:</strong> {{ $post->description }}</p>
                <p><strong>Status:</strong> {{ $post->status }}</p>
            </div>
        </div>
    </div>
</x-layout--admin>
