@if ($relatedProducts->isNotEmpty())
    @foreach ($relatedProducts as $relatedProduct)
        <div class="bg-white shadow rounded-lg p-3 w-full max-w-[240px] group">
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('assets/images/product/' . $relatedProduct->thumbnail) }}"
                    alt="{{ $relatedProduct->name }}"
                    class="w-full object-cover transition-transform duration-500 group-hover:scale-105">

                <!-- Nút hover -->
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                    <div class="space-x-2">
                        <button class="px-4 py-1.5 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                            Vào giỏ
                        </button>
                        <a href="{{ route('site.product.detail', ['slug' => $relatedProduct->slug]) }}"
                            class="px-4 py-1.5 bg-white text-gray-700 text-sm rounded hover:bg-gray-200">
                            Chi tiết
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tên và giá -->
            <div class="mt-3">
                <h3 class="text-sm font-medium text-gray-900 truncate">
                    {{ $relatedProduct->name }}
                </h3>
                <p class="text-red-600 text-base font-bold mt-1">
                    Giá gốc của sản phẩm
                    {{ number_format($relatedProduct->price_root, 0, ',', '.') }}₫
                </p>
                @if ($relatedProduct->price_sale > 0 && $relatedProduct->price_root > $relatedProduct->price_sale)
                    <p class="text-sm text-green-600 font-medium">
                        Chỉ còn:
                        {{ number_format($relatedProduct->price_root - $relatedProduct->price_sale, 0, ',', '.') }}₫
                    </p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div>Không tìm thấy sản phẩm liên quan</div>
@endif








{{-- @if ($relatedProducts->isNotEmpty())
        <div class="related-products">
            <h3>Sản phẩm liên quan</h3>
            <div class="products-list">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="product">
                        <img src="{{ asset('assets/images/product/' . $relatedProduct->thumbnail) }}"
                            alt="{{ $relatedProduct->name }}">
                        <p>{{ $relatedProduct->name }}</p>
                        <p>{{ number_format($relatedProduct->price, 0, ',', '.') }} VNĐ</p>
                        <a href="{{ route('site.product.detail', $relatedProduct->slug) }}">Xem chi tiết</a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div>Không tìm thấy sản phẩm liên quan</div>
    @endif --}}
