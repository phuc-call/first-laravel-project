@if (count($product_list) > 0)
    <div class="grid md:grid-cols-4 grid-cols-2 gap-5">
        @foreach ($product_list as $product_row)
            <x-product-card :productrow="$product_row" />
        @endforeach
    </div>
    <div class="flex justify-center py-3">
        <ul class="flex" id="pagination">
            {{ $product_list->links() }}
        </ul>
    </div>
@else
    <h1>KHÔNG TÌM THẤY SẢN PHẨM</h1>
@endif
