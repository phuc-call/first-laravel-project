<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class RelatedProducts extends Component
{
    public $product_id;
    public $category_id;
    public $brand_id;

    public function __construct($productId, $brandId, $categoryId)
    {
        $this->product_id = $productId;
        $this->brand_id = $brandId;
        $this->category_id = $categoryId;
    }


    public function render(): View|Closure|string
    {
        // Lấy các sản phẩm cùng danh mục nhưng khác sản phẩm hiện tại
        $relatedProducts = Product::select('id', 'name', 'thumbnail', 'price_sale', 'price_root', 'slug', 'category_id')
            ->where('status', 1)
            ->where('category_id', $this->category_id)
            ->where('id', '!=', $this->product_id)
            ->orderBy('created_at', 'desc')
            ->limit(4) // số lượng tùy ý
            ->get();

        return view('components.related-products', compact('relatedProducts'));
    }
}
