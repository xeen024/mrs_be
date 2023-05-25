<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createPersonalInfo($data){
        $personal_info_data = PersonalInformation::create([
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'gender' => $data->gender,
            'birthdate' => $data->birthdate,
            'age' => $data->age,
            'contact_number' => $data->contact_number,
            'civil_status' => $data->civil_status,
            'religion' => $data->religion,
            'phic_no' => $data->phic_no
        ]);

        return $personal_info_data->id;
    }

    public function updatePersonalInfo($data){
        $personal_info_data = PersonalInformation::updateOrCreate([
            'id' => $data->information_id
        ],[
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'gender' => $data->gender,
            'birthdate' => $data->birthdate,
            'age' => $data->age,
            'contact_number' => $data->contact_number,
            'civil_status' => $data->civil_status,
            'religion' => $data->religion,
            'phic_no' => $data->phic_no
        ]);

        return $personal_info_data->id;
    }
}
