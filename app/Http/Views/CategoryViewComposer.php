<?php

namespace App\Http\Views;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryViewComposer
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function compose($view)
    {
        return $view->with('categories', $this->category->all());
    }
}
