<x-layout--admin>
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('banner.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>
    </div>
    <div>
        <p><strong>Id:</strong>{{ $banner->id }}</p>
        <p><strong>Name:</strong>{{ $banner->name }}</p>
        <p><strong>slug:</strong>{{ $banner->slug }}</p>
        <p><strong>status:</strong>{{ $banner->status }}</p>
        <p><strong>Description:</strong>{{ $banner->description }}</p>
        <p>
            <strong>Hình ảnh:</strong><br>
            @if (!empty($banner->image))
                <img class="w-32 h-32 object-cover" src="{{ asset('assets/images/banner/' . $banner->image) }}"
                    alt="">
            @else
                <p>không có ảnh</p>
            @endif
        </p>
    </div>
</x-layout--admin>
