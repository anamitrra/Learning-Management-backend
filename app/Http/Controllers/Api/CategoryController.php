<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
           'message' => 'Success',
           'slider' => $categories]);
    }

    public function topCategories() : Object
    {
        $topCategories = Category::limit(5)->get();
        return response()->json([
            'message'=> 'Success',
            'topCategories'=>$topCategories
        ]);
    }
}
