<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class productForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?int $category_id,
        public Collection $categories,
        public ?Product $product    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-form');
    }
}
