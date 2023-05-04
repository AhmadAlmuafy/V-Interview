<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\Company;

class CompanyController extends Controller {
    
    public function getProfile(Request $request) {

        $profile = Company::find(Auth::guard("CompanyApi") -> user() -> id);

        return response() -> json([
            "message" => "success",
            "message" => "Photo updated successfully",
            "profile" => $profile
        ], 200);

    }

    public function updateProfile(Request $request) {

        $requestData = $request -> all();
        $rules = [
            'industry" => "string',
            'website" => "url|string|max:255',
            'founded" => "date',
            'description" => "string',
            'photo" => "image|mimes:jpg,jpeg,png,bmp',
            'full_name' => 'max:100|string',
            'email' => 'email|max:150|unique:company',
            'password' => 'min:6|string',
            'location' => 'string',
            'phone' => 'string|max:15',
        ];

        $valid = Validator::make($requestData, $rules);

        if (!$valid -> fails()) {

            $user = Company::find(Auth::guard("CompanyApi") -> user() -> id);
            
            if ($user) {

                if ($request -> has("photo")) {

                    $photo = Storage::disk('companyUploads') -> put('profile', $request -> file("photo"));
                    $requestData["photo"] = $photo;

                }

                if ($request -> has("password")) {

                    $requestData['password'] = Hash::make($request -> input("password"));

                }

                $user -> update($requestData);
                return response() -> json([
                    "status" => "success",
                    "message" => "profile filled successfully"
                ], 200);

            }
            
            return response() -> json([
                "status" => "error",
                "message" => "User not found"
            ], 400);

        }

        return response() -> json([
            "status" => "error",
            "messages" => $valid -> errors()
        ], 400);

    }

}
