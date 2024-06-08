<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\LoadoutResource;
use App\Models\Category;
use App\Models\Loadout;

class CategoryLoadoutController extends Controller
{
    public function index(Category $category)
    {
        $loadouts = Loadout::query()
            ->byCategory($category->name)
            ->with('user', 'gun.category')
            ->get();

        $categories = Category::query()->get();

        return inertia('Categories/Loadouts/Index', [
            'loadouts' => LoadoutResource::collection($loadouts),
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
