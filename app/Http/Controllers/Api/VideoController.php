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
            ->get(['id', 'title', 'description', 'image', 'video_path']);
        return response()->json([
            'success' => true,
            'data' => $freeVideos
        ]);
    }

    public function getAllVideos()
    {
        $videos = Video::all(['id', 'title', 'description', 'image', 'video_path']);
        
        return response()->json([
            'success' => true,
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
            'data' => [
                'video_url' => asset('storage/' . $video->video_path)
            ]
        ]);
    }


}
