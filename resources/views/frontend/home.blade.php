<x-layout-site>
    <x-slot:title>Trang Chủ</x-slot:title>

    <!-- SẢN PHẨM MỚI -->


    <!-- SẢN PHẨM -->
    <main class="mx-auto">
        <div class="header-main">
            <div class="group w-full flex justify-center items-center mt-9 mb-9 overflow-hidden">
                <img src="{{ asset('asset/images/banner.webp') }}"
                    class="w-full h-auto transform transition-all duration-500 ease-in-out group-hover:scale-105">
            </div>

            <div class="overflow-x-auto">
                <h1 class="text-lg text-red-500">SẢN PHẨM MỚI</h1>
                <div class="whitespace-nowrap">
                    <x-product-new />
                </div>
            </div>
            <hr>
            <div class="list">
                <h1 class="text-lg text-red-500">Sản phẩm khuyến mãi</h1>
                <x-product-sale />
            </div>
        </div>
    </main>
</x-layout-site>
