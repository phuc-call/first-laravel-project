<x-layout-site>
    <x-slot:title>Sản Phẩm </x-slot:title>
    <x-slot:header>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </x-slot:header>
    <x-slot:footer>
        <script>
            $(document).ready(function() {
                function fetchProducts(page = 1) {
                    let category = $('#category').val();
                    let brand = $('#brand').val();
                    $.ajax({
                        url: "{{ route('site.product') }}" + "?page=" + page,
                        type: "GET",
                        data: {
                            category: category,
                            brand: brand
                        },
                        success: function(response) {
                            $('#product-list').html(response);
                        }
                    });
                }
                // khi chọn category hoặc brand
                $('#category, #brand').change(function() {
                    fetchProducts(1);
                });
                // bắt sự kiện phân trang
                $(document).on('click', '#pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetchProducts(page);
                });
            })
        </script>
    </x-slot:footer>
    <main>

        <main class="max-w-7xl mx-auto">
            <div class="header-main">
                <div class="group w-full flex justify-center items-center mt-9 mb-9 overflow-hidden">
                    <img src="{{ asset('asset/images/banner.webp') }}"
                        class="w-full transform transition-all duration-500 ease-in-out group-hover:scale-105">
                </div>
                <div class="list">
                    DANH SÁCH SẢN PHẨM
                </div>
            </div>
            <div>
                <select name="category" id="category" class="w-full md:w-1/4 p-2 border border-gray-300 rounded-md mb-4">
                    <option value="all">Chọn danh mục</option>
                    @foreach ($category_list as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="brand" id="brand"
                    class="w-full md:w-1/4 p-2 border border-gray-300 rounded-md mb-4">
                    <option value="all">Chọn thương hiệu</option>
                    @foreach ($brand_list as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mx-auto">
                <div id="product-list" class="mt-7">
                    <!-- Danh sách sản phẩm -->
                    <div class="flex flex-wrap gap-4 justify-start">
                        <!-- Sản phẩm váy -->
                        <x-all-product :product_list="$product_list" />
                    </div>
                    <div class="flex justify-center py-5">
                        {{ $product_list->links() }}
                    </div>
                </div>
            </div>

        </main>
</x-layout-site>
