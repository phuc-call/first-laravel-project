<x-layout--admin>
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('topic.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>
    </div>
    <div>
        <p><strong>Id:</strong>{{ $topic->id }}</p>
        <p><strong>Name:</strong>{{ $topic->name }}</p>
        <p><strong>slug:</strong>{{ $topic->slug }}</p>
        <p><strong>status:</strong>{{ $topic->status }}</p>
        <p><strong>Description:</strong>{{ $topic->description }}</p>
    </div>
</x-layout--admin>
