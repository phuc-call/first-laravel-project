<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class ProductSale extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product_list = Product::select('id', 'name', 'thumbnail', 'slug', 'price_sale', 'price_root')
            ->where([['status', '=', 1], ['price_sale', '!=', 0]])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        return view('components.product-sale', compact('product_list'));
    }
}
