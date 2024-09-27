<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   public function updateProfile( Request $request) {
    
    $validator = Validator::make($request->all(), [
        'phone_number' => 'required|string',
        'email' => 'nullable|email|unique:users,email,',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    
    $authUser = Auth::user();
    if (!$authUser) {
        return response()->json(['message' => 'Unauthorized.'], 401);
    }
    $user = User::where('phone_number', $request->phone_number)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
    }

    $dataToUpdate = [
        'email' => $request->email,
    ];

        if ($request->hasFile('profile_picture')) {

            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $dataToUpdate['profile_picture'] = $path; 
        }

       $updatedUser=  User::where('phone_number', $request->phone_number)->update($dataToUpdate);
        return response()->json(['message' => 'Profile updated successfully.', 'user' => $updatedUser]);
   }
}
