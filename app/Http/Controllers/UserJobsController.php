<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\UserJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserJobsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = UserJobs::where('user_id', auth()->user()->id)->get();

        return $this->successResponse($data);
    }

    public function store(Request $request)
    {
        $checkIfExists = UserJobs::where('user_id', auth()->user()->id)->where('job_id', $request->job_id)->first();

        if ($checkIfExists) {
            return $this->errorResponse('Job already exists', 400);
        }

        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:jobs,id'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $data = UserJobs::create([
            'user_id' => auth()->user()->id,
            'job_id' => $request->job_id
        ]);

        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = UserJobs::where('user_id', auth()->user()->id)->where('job_id', $id)->first();

        if (!$data) {
            return $this->errorResponse('Job not found', 404);
        }

        $validStatus = [
            "view",
            "register"
        ];

        if (!in_array($request->status, $validStatus)) {
            return $this->failedResponse('Invalid status, status must be view or register', 400);
        }

        $data->update([
            'status' => $request->status ?? 'view'
        ]);

        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = UserJobs::where('user_id', auth()->user()->id)->where('job_id', $id)->first();

        if (!$data) {
            return $this->errorResponse('Job not found', 404);
        }

        $data->delete();

        return $this->successResponse($data, 'Data successfully deleted');
    }
}
