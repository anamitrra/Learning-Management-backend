<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController 
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string  '
        ]);

        $existingUser = User::where('phone_number', $request->phone_number)->first();
        $phoneNumber = $request->phone_number;

        if ($existingUser) {
          
            $otp = $this->otpService->generateOtp($phoneNumber);
            return response()->json([
                'message' => 'OTP sent for login',
                'otp' => $otp
            ]);
        }

        $otp = $this->otpService->generateOtp($phoneNumber);
             return response()->json([
            'message' => 'OTP sent for registration.',
            'otp' => $otp 
        ]);

    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|unique:users',
            'otp' => 'required|string'
        ]);

        $otpValid = $this->otpService->verifyOtp($request->phone_number, $request->otp);

        if (!$otpValid) {
            return response()->json([
                'message' => 'Invalid OTP.'
            ], 400);
        }
        $userExists = User::where('phone_number', $request->phone_number)->first();

         if (!$userExists) {
            $user = User::create([
                'phone_number' => $request->phone_number
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'message' => 'OTP verified, user logged in.',
            'token' => $token]);
    }
}

