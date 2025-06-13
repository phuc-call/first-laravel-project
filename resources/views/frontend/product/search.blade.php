<x-layout-site>
    <x-slot:title>Kết quả tìm kiếm</x-slot:title>

    <div class="container mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Kết quả tìm kiếm cho: "{{ $query }}"</h1>

        @if ($products->isEmpty())
            <p class="text-gray-600">Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </div>
</x-layout-site>