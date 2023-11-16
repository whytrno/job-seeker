<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\Profiles;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "role_id" => "required|integer|exists:roles,id",
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $user = User::create([
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        $user->profile()->create([
            "name" => $request->name,
        ]);

        $insertedUser = User::with(['role', 'profile'])->find($user->id);

        return $this->successResponse($insertedUser, "Register Successfully", 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if (!Auth::guard("web")->attempt($request->only('email', 'password'))) {
            return $this->failedResponse('Invalid Credentials', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        // return response($response)->withCookie('auth_token', $token, $this->expiration * 60);

        $user = User::where('email', $request['email'])->with('role')->first();

        return $this
            ->successResponse([
                'user' => $user,
                'token' => $token
            ], "Login Successfully", 200)
            ->withCookie('auth_token', $token, 60);
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->with(['profile', 'socialMedia', 'role'])->first();

        return $this->successResponse($user);
    }

    public function profileStoreOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'string',
            'phone' => 'string',
            'industry_ids' => 'array',
            'industry_ids.*' => 'exists:industries,id',

            'province_id' => 'int',
            'regency_id' => 'int',
            'village_id' => 'int',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $profile = Profiles::where('user_id', auth()->user()->id)->first();
        $profile->update([
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'industry_ids' => $request->industry_ids,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'village_id' => $request->village_id,
        ]);

        return $this->successResponse($profile);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
