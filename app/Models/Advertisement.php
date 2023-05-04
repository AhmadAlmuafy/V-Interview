<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\JobTitle;
use App\Models\Location;
use App\Models\Salary;
use App\Models\Employment_type;
use App\Models\Dataset;
use App\Models\Company;

class Advertisement extends Model {
    use HasFactory;

    protected $guarded = [];

    public function JobTitle() {

        return $this -> belongsTo(JobTitle::class, "job_title_id", "id");

    }

    public function Location() {

        return $this -> belongsTo(Location::class, "location_id", "id");

    }

    public function Salary() {

        return $this -> belongsTo(Salary::class, "salary_id", "id");

    }

    public function EmploymentType() {

        return $this -> belongsTo(Employment_type::class, "employment_type_id", "id");

    }

    public function Dataset() {

        return $this -> belongsTo(Dataset::class, "data_set_id", "id");

    }

    public function Company() {

        return $this -> belongsTo(Company::class, "company_id", "id");

    }

}
