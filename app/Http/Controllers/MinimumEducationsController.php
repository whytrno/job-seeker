<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\MinimumEducations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MinimumEducationsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = MinimumEducations::all();

        return $this->successResponse($data);
    }

    public function detail($id)
    {
        $data = MinimumEducations::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        return $this->successResponse($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:minimum_educations,name",
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $data = MinimumEducations::create([
            "name" => $request->name,
        ]);

        return $this->successResponse($data, "Data successfully Created", 201);
    }

    public function update(Request $request, $id)
    {
        $data = MinimumEducations::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:minimum_educations,name," . $id,
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $data->update([
            "name" => $request->name,
        ]);

        return $this->successResponse($data, "Data successfully updated");
    }

    public function destroy($id)
    {
        $data = MinimumEducations::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        $data->delete();

        return $this->successResponse(null, "Data successfully Deleted");
    }
}
