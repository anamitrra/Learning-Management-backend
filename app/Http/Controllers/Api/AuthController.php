<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


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
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $phone_number = $request->phone_number;
        $otp = $request->otp;

        $otpValid = $this->otpService->verifyOtp($phone_number, $otp);

        // dd($otpValid);
        if (!$otpValid) {
            return response()->json([
                'message' => 'Invalid OTP.'
            ], 400);
        }
        $user = User::firstOrCreate(['phone_number' => $phone_number]);
        $token = $user->createToken('auth_token',[],now()->addMinutes(60))->plainTextToken;

        return response()->json([
            'message' => 'OTP verified, user logged in.',
            'token' => $token]);
    }
}

