<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\SalaryRanges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryRangesController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = SalaryRanges::all();

        return $this->successResponse($data);
    }

    public function detail($id)
    {
        $data = SalaryRanges::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        return $this->successResponse($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:salary_ranges,name",
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $data = SalaryRanges::create([
            "name" => $request->name,
        ]);

        return $this->successResponse($data, "Data successfully Created", 201);
    }

    public function update(Request $request, $id)
    {
        $data = SalaryRanges::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:salary_ranges,name," . $id,
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
        $data = SalaryRanges::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        $data->delete();

        return $this->successResponse(null, "Data successfully Deleted");
    }
}
