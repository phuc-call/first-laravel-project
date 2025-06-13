<x-layout--admin>
    <x-slot name="title">Chi tiết Thương Hiệu</x-slot>
    <div class="container mt-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('brand.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh
                sách</a>
        </div>
        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <td>{{ $brand->id }}</td>
            </tr>
            <tr>
                <th>Tên</th>
                <td>{{ $brand->name }}</td>
            </tr>
            <tr>
                <th>Slug</th>
                <td>{{ $brand->slug }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if ($brand->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-secondary">Ẩn</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Thứ tự</th>
                <td>{{ $brand->sort_order }}</td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>{{ $brand->description }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Hình ảnh:</strong><br>
                    @if (!empty($brand->image))
                        <img class="w-32 h-32 object-cover" src="{{ asset('assets/images/brand/' . $brand->image) }}"
                            alt="">
                    @else
                        <p>không có ảnh</p>
                    @endif

                </td>
            </tr>
        </table>

    </div>
</x-layout--admin>
