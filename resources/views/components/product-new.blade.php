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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('product-container');
        const btnLeft = document.getElementById('scroll-left');
        const btnRight = document.getElementById('scroll-right');
        const scrollAmount = 300; // Số pixel cuộn mỗi lần

        // Kiểm tra trạng thái nút
        function updateButtons() {
            btnLeft.style.display = container.scrollLeft > 0 ? 'block' : 'none';
            btnRight.style.display = container.scrollLeft + container.clientWidth < container.scrollWidth ?
                'block' : 'none';
        }

        // Cuộn sang trái
        btnLeft.addEventListener('click', function() {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        // Cuộn sang phải
        btnRight.addEventListener('click', function() {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        // Cập nhật trạng thái nút khi cuộn
        container.addEventListener('scroll', updateButtons);

        // Cập nhật trạng thái nút ban đầu
        updateButtons();
    });
</script>
