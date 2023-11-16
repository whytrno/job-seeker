<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\UserSocialMedias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSocialMediasController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = UserSocialMedias::where('user_id', auth()->user()->id)->first();

        return $this->successResponse($data);
    }

    public function storeOrUpdate(Request $request)
    {
        $checkIfExists = UserSocialMedias::where('user_id', auth()->user()->id)->first();

        $validator = Validator::make($request->all(), [
            'facebook_username' => 'string',
            'instagram_username' => 'string',
            'tiktok_username' => 'string',
            'twitter_username' => 'string',
            'linkedin_username' => 'string',
            'spoken_language_ids' => 'array',
            'spoken_language_ids.*' => 'exists:languages,id',
            'website' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        if ($checkIfExists) {
            $checkIfExists->update([
                'facebook_username' => $request->facebook_username,
                'instagram_username' => $request->instagram_username,
                'tiktok_username' => $request->tiktok_username,
                'twitter_username' => $request->twitter_username,
                'linkedin_username' => $request->linkedin_username,
                'spoken_language_ids' => $request->spoken_language_ids,
                'website' => $request->website,
            ]);

            return $this->successResponse($checkIfExists);
        } else {
            $data = UserSocialMedias::create([
                'user_id' => auth()->user()->id,
                'facebook_username' => $request->facebook_username,
                'instagram_username' => $request->instagram_username,
                'tiktok_username' => $request->tiktok_username,
                'twitter_username' => $request->twitter_username,
                'linkedin_username' => $request->linkedin_username,
                'spoken_language_ids' => $request->spoken_language_ids,
                'website' => $request->website,
            ]);

            return $this->successResponse($data);
        }
    }
}
