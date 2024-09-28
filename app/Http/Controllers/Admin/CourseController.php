<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $category = Course::all();
        return view('admin.course.index', compact('course'));
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function edit(Course $course)
    {
        return view('admin.course.edit', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('course_image')->store('course', 'public');

        Course::create([
            'course_name' => $request->course_name,
            'course_image' => $path,
        ]);

        return redirect()->route('admin.course.index')->with('success', 'Course created successfully.');
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('course_image')) {
            if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
                Storage::disk('public')->delete($course->course_image);
            }

            $path = $request->file('course_image')->store('courses', 'public');
            $course->course_image = $path;
        }

        $course->course_name = $request->course_name;
        $course->save();

        return redirect()->route('admin.course.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.course.index')->with('success', 'course soft deleted successfully.');
    }

    public function restore(Course $course)
     {
         $course->restore();
         return redirect()->route('admin.course.index')->with('success', 'course restored successfully.');
     }

     public function forceDelete($id)
     {
         $course = Course::withTrashed()->findOrFail($id);
         
         if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
             Storage::disk('public')->delete($course->course_image);
         }
 
         $course->forceDelete();
         return redirect()->route('admin.course.index')->with('success', 'course permanently deleted.');
     }


}

