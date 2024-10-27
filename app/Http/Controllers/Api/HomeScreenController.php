<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Http\Controllers\Api\CategoryController;

class HomeScreenController extends Controller
{

    public function homeScreenData()  {

        $topCategoriesResponse = $this->topCategories(); 
        $topCategoriesData = json_decode($topCategoriesResponse->getContent(), true);

        $topVideosResponse = $this->topVideos(); 
        $topVideosData = json_decode($topVideosResponse->getContent(), true);

        $latestVideosResponse = $this->latestVideos(); 
        $latestVideosData = json_decode($latestVideosResponse->getContent(), true);


        $freeVideosResponse = $this->getFreeVideos();
        $freeVideosData = json_decode($freeVideosResponse->getContent(), true);



        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data'=>[
            'top_categories' => $topCategoriesData['data'],
            'top_videos' => $topVideosData['data'],
            'free_videos' => $freeVideosData['data'],
            'latest_videos' => $latestVideosData['data'] 
            ]
        ],200);
    }


    public function topVideos()
    {
        $topVideos = Video::limit(10)->get();

        $videos = $topVideos->map(function($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'description' => $video->description,
                    'image' => asset('storage/'.$video->image),
                    'video_url' => asset('storage/'.$video->video_path)
                ];
            });
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $videos
        ],200);
    }

    public function latestVideos()
    {
        $latestVideos = Video::orderBy('created_at', 'desc') 
        ->limit(10)
        ->get();


        $videos = $latestVideos->map(function($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'description' => $video->description,
                    'image' => asset('storage/'.$video->image),
                    'video_url' => asset('storage/'.$video->video_path)
                ];
            });
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $videos
        ],200);
    }
    

    public function getFreeVideos()
    {
        $freeVideos = Video::where('is_free', true)
            ->take(10)
            ->get();

        $videos = $freeVideos->map(function($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'description' => $video->description,
                    'image' => asset('storage/'.$video->image),
                    'video_url' => asset('storage/'.$video->video_path)
                ];
            });
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $videos
        ],200);
    }

    public function topCategories() 
    {
        $topCategories = Category::limit(5)->get();
    
        $categories = $topCategories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->category_name,
                'image' => asset('storage/'.$category->category_image),
            ];
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $categories,
            'view_all' => 'View All'
        ],200);
    }



}
