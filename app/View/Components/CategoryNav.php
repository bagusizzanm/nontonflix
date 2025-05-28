<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class CategoryNav extends Component
{
  public $categories;

  public function __construct()
  {
    $data = Cache::remember('nav_categories', 3600, function () {
      return Category::select('id', 'title', 'slug')
        ->orderBy('title', 'asc')->get();
    });

    $this->categories = $data->chunk(ceil($data->count() / 3));
  }

  public function render(): View|Closure|string
  {
    return view('components.category-nav');
  }
}
