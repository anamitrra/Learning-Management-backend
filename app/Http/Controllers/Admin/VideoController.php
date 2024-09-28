<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos')); 
    }

   public function create()
    {
        return view('videos.create'); 
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video')); 
    }

    public function show(Video $video)
    {
        return view('videos.show', compact('video')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'category' => 'required|string',
            'course' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video' => 'required|mimes:mp4,mov,avi,flv|max:200000',
            'is_free' => 'required|boolean',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        $video = Video::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'long_description' => $validated['long_description'],
            'category' => $validated['category'],
            'course' => $validated['course'],
            'image' => $imagePath,
            'video_path' => $videoPath, 
            'is_free' => $validated['is_free'],
        ]);
        return redirect()->route('videos.index')->with('success', 'Video created successfully!');
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'category' => 'required|string',
            'course' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,flv|max:200000', 
            'is_free' => 'required|boolean',
        ]);


        if ($request->hasFile('video')) {
            if ($video->video_path) {
                Storage::disk('public')->delete($video->video_path);
            }
            $videoPath = $request->file('video')->store('videos', 'public');
        } else {
            $videoPath = $video->video_path;
        }

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : $video->image;

        $video->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'long_description' => $validated['long_description'],
            'category' => $validated['category'],
            'course' => $validated['course'],
            'image' => $imagePath,
            'video_path' => $videoPath,
            'is_free' => $validated['is_free'],
        ]);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        if ($video->video_path) {
            Storage::disk('public')->delete($video->video_path);
        }

        if ($video->image) {
            Storage::disk('public')->delete($video->image);
        }

        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully!');
    }

}
