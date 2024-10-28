<?php
namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OtpService
{
    public function generateOtp(string $phoneNumber): string
    {
        $otp = rand(10000, 99999); 
        $expiresAt = Carbon::now()->addMinutes(5);

        Otp::updateOrCreate(
            ['phone_number' => $phoneNumber],
            ['otp' => Hash::make($otp), 
            'expires_at' => $expiresAt]
        );
        return $otp;
    }

    public function verifyOtp(string $phoneNumber, string $otp): bool
    {
        $otpRecord = Otp::where('phone_number', $phoneNumber)
                        ->where('expires_at', '>', now())
                        ->first();

        if (!$otpRecord) {
            return false; 
        }
        return Hash::check($otp, $otpRecord->otp);
    }
}
