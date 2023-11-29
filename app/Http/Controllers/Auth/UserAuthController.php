<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ApiMail;

class UserAuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'name' => 'required|min:4',
            'email' => 'required|email',
            'age' => 'required',
            'password' => 'required|min:3',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'role' => 1,
            'password' => Hash::make($request->password)
        ]);
        $mailData = [
            "email" => $request->email,
            "password" =>  $request->password
        ];
        Mail::to($mailData['email'])->send(new ApiMail($mailData));
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }   

   
}
