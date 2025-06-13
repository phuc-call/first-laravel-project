<x-layout--admin>
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('category.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh
                sách</a>
        </div>
        <div class="card-body">
            <p><strong>Tên:</strong> {{ $category->name }}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
            <p><strong>Mô tả:</strong> {!! $category->description !!}</p>
            <p><strong>Trạng thái:</strong> {{ $category->status ? 'Hiển thị' : 'Ẩn' }}</p>
            <p>
                <strong>Hình ảnh:</strong><br>
                @if (!empty($category->image))
                    <img class="w-32 h-32 object-cover" src="{{ asset('assets/images/category/' . $category->image) }}"
                        alt="">
                @endif
            </p>
        </div>
    </div>
</x-layout--admin>
