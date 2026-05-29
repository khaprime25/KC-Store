<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Closure;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;

class ProductVariantComponent extends Component
{
    public function __construct(
        public ?int $category_id = null,
        public ?int $product_id = null,
        public ?Collection $products = null,
        public ?ProductVariant $productVariant = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.product-variant');
    }
}