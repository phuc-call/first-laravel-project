<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;


class ProductNew extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product_list = Product::select('id', 'name', 'thumbnail', 'price_sale', 'price_root', 'slug')
            ->where('status', '=', 1)
            ->orderBy('created_at', 'desc') // Có thể sắp xếp theo thời gian mới nhất
            ->limit(6)
            ->get();

        return view('components.product-new', [
            'product_list' => $product_list
        ]);
    }
}
