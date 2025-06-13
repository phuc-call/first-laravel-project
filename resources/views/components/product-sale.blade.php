<section class="relative product_hot mx-auto mt-5 px-4">
    <!-- Nút nhấn trái -->
    <button id="scroll-left"
        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-200 p-2 rounded-full shadow hover:bg-gray-300 z-10 hidden">
        &larr;
    </button>

    <!-- Danh sách sản phẩm -->
    <div id="product-container" class="flex gap-6 overflow-x-auto whitespace-nowrap scroll-smooth no-scrollbar">
        @foreach ($product_list as $product_row)
            <div class="inline-block">
                <x-product-card :productrow="$product_row" />
            </div>
        @endforeach
    </div>

    <!-- Nút nhấn phải -->
    <button id="scroll-right"
        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-200 p-2 rounded-full shadow hover:bg-gray-300 z-10">
        &rarr;
    </button>
</section>
