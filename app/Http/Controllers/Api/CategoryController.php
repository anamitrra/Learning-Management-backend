<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::all()->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->category_name,
                'image' => asset('storage/'.$category->category_image)
            ];
        });

        return response()->json([
           'success' => true,
           'message' => 'Data Fetched Successfully',
           'data' => $categories]);
    }

    public function topCategories() 
    {
        $topCategories = Category::limit(5)->get();
    
        $categories = $topCategories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->category_name,
                'image' => asset('storage/'.$category->category_image),
                'view_all' => 'View All'
            ];
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $categories
        ],200);
    }
    
}
