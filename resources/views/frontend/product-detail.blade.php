<x-layout-site>
    <x-slot:title>Chi tiết</x-slot:title>
    <!-- Product Detail -->
    <section class="container mx-auto py-12 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div class="flex justify-center">
                <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" alt="Sản phẩm"
                    class="rounded-lg shadow-lg hover:scale-105 transition duration-300 ease-in-out transform">
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <h2 class="text-3xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-xl text-blue-600">{{ $product->price_root }} VND</p>

                <div class="flex items-center space-x-4">
                    <span class="text-lg font-medium text-gray-700">Đánh giá:</span>
                    <div class="flex text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.053.142-.205.23-.36.23-.217 0-.423-.138-.505-.351l-1.642-5.002-5.187-.035c-.217-.001-.39-.177-.39-.383 0-.137.072-.267.188-.33l4.857-3.682-1.826-5.355c-.104-.297-.004-.633.228-.792.233-.159.53-.145.735.04l4.39 3.18 4.39-3.18c.205-.185.502-.199.735-.04.233.159.332.495.228.792l-1.826 5.355 4.857 3.682c.116.063.188.193.188.33 0 .206-.173.382-.39.383l-5.187.035-1.642 5.002c-.115.213-.289.351-.505.351-.155 0-.307-.088-.36-.23L8 12.657l-3.612 2.786z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.053.142-.205.23-.36.23-.217 0-.423-.138-.505-.351l-1.642-5.002-5.187-.035c-.217-.001-.39-.177-.39-.383 0-.137.072-.267.188-.33l4.857-3.682-1.826-5.355c-.104-.297-.004-.633.228-.792.233-.159.53-.145.735.04l4.39 3.18 4.39-3.18c.205-.185.502-.199.735-.04.233.159.332.495.228.792l-1.826 5.355 4.857 3.682c.116.063.188.193.188.33 0 .206-.173.382-.39.383l-5.187.035-1.642 5.002c-.115.213-.289.351-.505.351-.155 0-.307-.088-.36-.23L8 12.657l-3.612 2.786z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.053.142-.205.23-.36.23-.217 0-.423-.138-.505-.351l-1.642-5.002-5.187-.035c-.217-.001-.39-.177-.39-.383 0-.137.072-.267.188-.33l4.857-3.682-1.826-5.355c-.104-.297-.004-.633.228-.792.233-.159.53-.145.735.04l4.39 3.18 4.39-3.18c.205-.185.502-.199.735-.04.233.159.332.495.228.792l-1.826 5.355 4.857 3.682c.116.063.188.193.188.33 0 .206-.173.382-.39.383l-5.187.035-1.642 5.002c-.115.213-.289.351-.505.351-.155 0-.307-.088-.36-.23L8 12.657l-3.612 2.786z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.053.142-.205.23-.36.23-.217 0-.423-.138-.505-.351l-1.642-5.002-5.187-.035c-.217-.001-.39-.177-.39-.383 0-.137.072-.267.188-.33l4.857-3.682-1.826-5.355c-.104-.297-.004-.633.228-.792.233-.159.53-.145.735.04l4.39 3.18 4.39-3.18c.205-.185.502-.199.735-.04.233.159.332.495.228.792l-1.826 5.355 4.857 3.682c.116.063.188.193.188.33 0 .206-.173.382-.39.383l-5.187.035-1.642 5.002c-.115.213-.289.351-.505.351-.155 0-.307-.088-.36-.23L8 12.657l-3.612 2.786z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Mô Tả Sản Phẩm</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>

                <!-- Add to Cart Button -->
                <div class="mt-6">
                    <button
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Thêm Vào Giỏ Hàng
                    </button>
                </div>
            </div>

        </div>
        <div class="">
            San Phẩm Liên Quan
            <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-6 gap-2 mt-8">
                <x-related-products :product-id="$product->id" :brand-id="$product->brand_id" :category-id="$product->category_id" />
            </div>
        </div>
    </section>
</x-layout-site>
