<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $item = null;

    public function __construct($productrow)
    {
        $this->item = $productrow;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = $this->item;
        return view('components.product-card', compact('product'));
    }
}
