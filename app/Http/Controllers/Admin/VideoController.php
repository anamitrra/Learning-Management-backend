<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('category')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::select('id', 'category_name')->get();
        $courses = Course::select('id', 'course_name')->get();
        return view('admin.videos.create', compact('categories', 'courses'));
    }

    public function edit(Video $video)
    {
        $categories = Category::select('id', 'category_name')->get();
        $courses = Course::select('id', 'course_name')->get();
        return view('admin.videos.edit', compact('video', 'categories', 'courses'));
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function store(Request $request)
    {



        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'category' => 'required|integer|exists:categories,id',
            'course' => 'nullable|integer|exists:courses,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video' => 'required|mimes:mp4,mov,avi,flv|max:200000',
            'is_free' => 'nullable',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        $video = Video::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'long_description' => $validated['long_description'],
            'category_id' => $validated['category'],
            'course' => $validated['course'],
            'image' => $imagePath,
            'video_path' => $videoPath,
            'is_free' => $request->has('is_free'),
        ]);
        return redirect()->route('videos.index')->with('success', 'Video created successfully!');
    }

    public function update(Request $request, Video $video)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'course' => 'nullable|integer|exists:courses,id', 
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,flv|max:200000',
            'is_free' => 'nullable',
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
            'category_id' => $validated['category_id'],
            'course_id' => $validated['course'],
            'image' => $imagePath,
            'video_path' => $videoPath,
            'is_free' => $request->has('is_free'),
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
