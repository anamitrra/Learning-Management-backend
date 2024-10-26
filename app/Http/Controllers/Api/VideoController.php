<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{

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

    public function videoByCategory($category,)
    {
       $videoByCategory = Video::where('category',$category)->get();

        $videos = $videoByCategory->map(function($video) {
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

    public function videoByCategoryId($id)
    {
       $videoByCategory = Video::find($id)->get();

        $videos = $videoByCategory->map(function($video) {
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



    public function getAllVideos()
    {
        $videos =  Video::all()->map(function($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
                'image' => asset('public/storage/'.$video->image),
                'video_url' => asset('public/storage/'.$video->video_path)
            ];
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => $videos
        ]);
    }

    public function playVideo($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'data' => [
                'video_url' => asset('public/storage/' . $video->video_path)
            ]
        ]);
    }


}
