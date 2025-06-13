<x-layout--admin>
    <div class="container mx-auto mt-5">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('product.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                        class="w-full h-auto rounded-lg">
                </div>
                <div>
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="mt-2"><strong>Giá:</strong> {{ number_format($product->price_root, 0, ',', '.') }} VNĐ
                    </p>
                    <p><strong>Giá khuyến mãi:</strong> {{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</p>
                    <p><strong>Số lượng:</strong> {{ $product->qty }}</p>
                    <p><strong>Trạng thái:</strong> {{ $product->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Mô tả sản phẩm</h3>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>

    </div>
</x-layout--admin>
