<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request)
    {
        //Validate user input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.User::class],
            'password' => ['required', 'max:50'],
        ]);

        //Error if validation fails
        if($validator->fails()){
            return response()->json(
                data: $validator->errors(),
                status: Response::HTTP_FORBIDDEN
            );
        }

        //Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(
            data: $user,
            status: Response::HTTP_CREATED
        );
    }

    //Login Function
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100'],
            'password' => ['required', 'max:50'],
        ]);

        //Error if validation fails
        if($validator->fails()){
            return response()->json(
                data: $validator->errors(),
                status: Response::HTTP_FORBIDDEN
            );
        }

        //Validate credentials - FIXED: use only email and password
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json(
                data: [
                    "status" => false,
                    "message" => "Invalid credentials"
                ],
                status: Response::HTTP_UNAUTHORIZED
            );
        }

        //Get user info and generate token
        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
                data: [
                    "status" => true, // ✅ FIXED: Changed from false to true
                    "token" => $token,
                    "data" => $user
                ],
                status: Response::HTTP_OK
            );
    }

    // Add logout method
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            data: [
                "status" => true,
                "message" => "Logged out successfully"
            ],
            status: Response::HTTP_OK
        );
    }
}