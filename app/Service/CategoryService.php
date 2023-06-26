<?php

namespace App\Service;

use App\Models\Category;

class CategoryService 
{
    public function getAll(): object
    {
        return Category::where('status', Category::STATUS_YES)->get();
    }
}
