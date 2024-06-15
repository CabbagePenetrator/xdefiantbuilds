<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class SelectGunController extends Controller
{
    public function __invoke()
    {
        $categories = Category::with('guns')->get();

        return inertia('SelectGun', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
