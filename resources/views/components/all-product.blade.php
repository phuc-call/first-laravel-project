<section class="relative mx-auto mt-5 px-4">

    <!-- Danh sách sản phẩm -->
    <div class="flex flex-wrap gap-4">
        @foreach ($product_list as $product)
            <div class="bg-white shadow rounded-lg p-3 w-full max-w-[240px] group">
                <div class="relative overflow-hidden rounded-lg">
                    <img src="{{ asset('assets/images/product/' . ($product->thumbnail ?? 'default.jpg')) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-[250px] object-cover transition-transform duration-500 group-hover:scale-105">

                    <!-- Nút hover -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                        <div class="space-x-2">
                            <button class="px-4 py-1.5 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                Vào giỏ
                            </button>
                            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}"
                                class="px-4 py-1.5 bg-white text-gray-700 text-sm rounded hover:bg-gray-200">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tên và giá -->
                <div class="mt-3">
                    <h3 class="text-sm font-medium text-gray-900 truncate">
                        {{ $product->name }}
                    </h3>
                    <p class="text-red-600 text-base font-bold mt-1">
                        Giá gốc của sản phẩm
                        {{ number_format($product->price_root, 0, ',', '.') }}₫
                    </p>
                    @if ($product->price_sale > 0 && $product->price_root > $product->price_sale)
                        <p class="text-sm text-green-600 font-medium">
                            Chỉ còn: {{ number_format($product->price_root - $product->price_sale, 0, ',', '.') }}₫
                        </p>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
</section>
