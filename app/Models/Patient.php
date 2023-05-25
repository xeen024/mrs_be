<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function addPatient($data){
        $patientData = Patient::create([
            'address_id' => $data->address_id,
            'personal_info_id' => $data->personal_info_id,
            'father_name' => $data->father_name,
            'mother_name' => $data->mother_name
        ]); 

        return $patientData;
    }

    public function updatePatientData($data){
        $patientData = Patient::updateOrCreate([
            'id' => $data->patient_id
        ],[
            'father_name' => $data->father_name,
            'mother_name' => $data->mother_name
        ]); 

        return $patientData;
    }

    public function getAllPatients(){
        // $all_patient_data = Patient::all();
        $all_patient_data = DB::table('patients')->select('patients.id',
                                'personal_information.firstname',
                                'personal_information.lastname',
                                'personal_information.gender',
                                'personal_information.birthdate',
                                'personal_information.age',
                                'personal_information.contact_number',
                                'personal_information.civil_status',
                                DB::raw("CONCAT(addresses.street,' ',
                                addresses.brgy,' ',
                                addresses.city,' ',
                                addresses.province,' ',
                                addresses.country)AS Address"),
                                'personal_information.religion'
                                )->join('addresses', 'addresses.id', 'patients.address_id')
                                ->join('personal_information', 'personal_information.id', 'patients.personal_info_id')
                                 ->get();

        return $all_patient_data;
    }
}
