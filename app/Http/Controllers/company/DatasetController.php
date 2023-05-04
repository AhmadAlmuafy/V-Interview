<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Dataset;
use App\Models\DatasetQA;

class DatasetController extends Controller {

    public function index() {
        //
    }

    public function store(Request $request) {

        $requestData = $request -> all();
        $rules = [
            'data_set_url" => "required|file|mimes:csv',
        ];

        $valid = Validator::make($requestData, $rules);
        if (!$valid -> fails()) {

            $CSVFile = $request -> file("data_set_url");
            $requestData["data_set_name"] = time() . "_" . $CSVFile -> getClientOriginalName();
            $requestData["company_id"] = Auth::guard("CompanyApi") -> user() -> id;

            $CSVPath = Storage::disk('companyUploads') -> put('datasets', $CSVFile);
            $requestData["data_set_url"] = $CSVPath;

            $dataset = Dataset::create($requestData);

            $csv = fopen($request -> file("data_set_url"), 'r');
            $i = 0;

            while (($filedata = fgetcsv($csv, 1000, ",")) !== FALSE) {
    
                $num = count($filedata);

                if ($i == 0) {
                    $i++;
                    continue;
                }

                DatasetQA::create([
                    "question" => $filedata[0],
                    "answer" => $filedata[1],
                    "data_set_id" => $dataset -> id,
                ]);

                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;

            }
    
            fclose($csv);

            return response() -> json([
                "status" => "success",
                "message" => "Dataset added successfully"
            ], 200);

        } else {

            return response() -> json([
                "status" => "error",
                "messages" => $valid -> errors()
            ], 400);

        }

    }

    public function show($id) {
        //
    }

    public function update(Request $request, $id) {
        
    }

    public function destroy($id) {
        
    }
}
