<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Advertisement;

class AdvertisementController extends Controller {

    public function index() {
        
        $advertisements = Advertisement::with(["JobTitle", "Dataset", "EmploymentType", "Location", "Salary", "Company"])
                                        -> where("company_id", Auth::guard("CompanyApi") -> user() -> id)
                                        -> get();

        return response() -> json([
            "status" => "success",
            "advertisements" => $advertisements
        ], 200);

    }

    public function store(Request $request) {

        $rules = [
            'job_details' => 'required|string',
            'skills' => 'required|string',
            'job_title_id' => 'required|exists:job_titles,id',
            'salary_id' => 'required|exists:salaries,id',
            'location_id' => 'required|exists:locations,id',
            'employment_type_id' => 'required|exists:employment_types,id',
            'data_set_id' => 'required|exists:datasets,id'
        ];

        $request["company_id"] = Auth::guard("CompanyApi") -> user() -> id;

        $valid = Validator::make($request -> all(), $rules);

        if (!$valid -> fails()) {

            $advertisement = Advertisement::create($request -> all());

            return response() -> json([
                "status" => "success",
                "message" => "Advertisement created successfully",
                "advertisement" => $advertisement
            ], 200);

        }

        return response() -> json([
            "status" => "error",
            "messages" => $valid -> errors()
        ], 400);

    }

    public function show($id) {
        
        $advertisement = Advertisement::with(["JobTitle", "Dataset", "EmploymentType", "Location", "Salary", "Company"])
                                        -> where("company_id", Auth::guard("CompanyApi") -> user() -> id)
                                        -> where("id", $id)
                                        -> get();

        return response() -> json([
            "status" => "success",
            "advertisement" => $advertisement
        ], 200);

    }

    public function update(Request $request, Advertisement $advertisement) {
        


    }

    public function destroy($id) {
        
        $advertisement = Advertisement::where("company_id", Auth::guard("CompanyApi") -> user() -> id)
                                        -> where("id", $id)
                                        -> delete();

        return response() -> json([
            "status" => "success",
            "message" => "Advertisement deleted successfully"
        ], 200);

    }

}
