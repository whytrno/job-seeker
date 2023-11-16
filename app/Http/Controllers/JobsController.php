<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = Jobs::all();

        return $this->successResponse($data);
    }

    public function my()
    {
        $data = Jobs::where('user_id', auth()->user()->id)->get();

        return $this->successResponse($data);
    }

    public function detail($id)
    {
        $data = Jobs::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        return $this->successResponse($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|unique:jobs,title",
            "description" => "required|string",
            "job_location_id" => "required|exists:job_locations,id",
            "experience_level_id" => "required|exists:experience_levels,id",
            "contract_type_id" => "required|exists:contract_types,id",
            "minimum_education_id" => "required|exists:minimum_educations,id",
            "salary_range_id" => "exists:salary_ranges,id",

            "job_category_ids" => "required|array",
            "industry_ids" => "required|array",
            "required_language_ids" => "required|array",

            "job_category_ids.*" => "required|exists:job_categories,id",
            "industry_ids.*" => "required|exists:industries,id",
            "required_language_ids.*" => "required|exists:languages,id",

            "province_id" => "required|int",
            "regency_id" => "required|int",
            "village_id" => "required|int",
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $data = Jobs::create([
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "description" => $request->description,
            "job_location_id" => $request->job_location_id,
            "experience_level_id" => $request->experience_level_id,
            "contract_type_id" => $request->contract_type_id,
            "minimum_education_id" => $request->minimum_education_id,
            "salary_range_id" => $request->salary_range_id,

            "province_id" => $request->province_id,
            "regency_id" => $request->regency_id,
            "village_id" => $request->village_id,

            "job_category_ids" => json_encode($request->job_category_ids),
            "industry_ids" => json_encode($request->industry_ids),
            "required_language_ids" => json_encode($request->required_language_ids),
        ]);

        return $this->successResponse($data, "Data successfully Created", 201);
    }

    public function update(Request $request, $id)
    {
        $data = Jobs::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        if ($data->user_id != auth()->user()->id) {
            return $this->failedResponse("You are not authorized to update this data");
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:job_categories,name," . $id,
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
        $data = Jobs::find($id);

        if (!$data) {
            return $this->failedResponse("Data not found");
        }

        if ($data->user_id != auth()->user()->id) {
            return $this->failedResponse("You are not authorized to update this data");
        }

        $data->delete();

        return $this->successResponse(null, "Data successfully Deleted");
    }
}
