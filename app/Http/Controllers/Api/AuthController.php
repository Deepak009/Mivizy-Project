<?php

namespace App\Http\Controllers\Api;

use Hash;
use Mail;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

use App\Events\OTPRequestGenerated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OtpRequest;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Api\SignInRequest;

class AuthController extends Controller
{
    /**
     * Constructor function
     *
     * @param UserService           $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function requestOTP(OtpRequest $request){
        try{
            $user = $this->service->findBy(
                                                $request->country_code,
                                                $request->phone_number
                                            );
            if ($user && $user->is_customer) {
                if($user->status == false){
                    return response()->json([
                        'message' => 'Your account has been disabled by the admin',
                    ], 403);
                }
                // OTP key 'OTP' with country_code and phone_number
                $key='otp'.$user->country_code.$user->phone_number;
                $otp = Cache::get($key);
                if(!$otp){
                    //generate OTP
                    $otp = generateOTP();
                    Cache::put($key, $otp, 60*10);
                }
                OTPRequestGenerated::dispatch(
                                            $user->country_code,
                                            $user->phone_number,
                                            $otp
                                        );
                return response()->json([
                                         'message' => 'OTP sent Successfully.',
                                        ], 200);
            }else{
                return response()->json(['message' => 'The given phone number is not registered'], 401);
            }
        }catch(Exception $e){
            throw $e;
        }
        return response()->json([
                'message' => 'Something went wrong.',
        ], 400);
    }

    public function signIn(SignInRequest $request){
        try{
            // OTP key 'OTP' with country_code and phone_number
            $key ='otp'.$request->country_code.$request->phone_number;
            $otp = Cache::get($key);
            if($request->otp == $otp)
            {
                Cache::forget($key);
                $user = $this->service->findBy(
                                                $request->country_code,
                                                $request->phone_number
                                            );
                if ($user && $user->is_customer) {
                    if ($user->status == false) {
                        return response()->json([
                            'message' => 'Your account has been disabled by the admin',
                        ], 403);
                    }
					$user->load('customer');
                    $access_token = $user->createToken('App token')->accessToken;
                    return response()->json([
                            'message' => 'Sign in successful',
                            'access_token' => $access_token,
                            'user' => $user
                    ], 200);
                }else{
                    return response()->json([
                                'message' => 'Invalid phone number or OTP',
                            ], 401);
                }
            }else{
                return response()->json(['message' => 'Invalid OTP',], 401);
            }
        }catch(Exception $e){
            throw $e;
        }
        return response()->json([
                'message' => 'Something went wrong.',
        ], 400);
    }
}
