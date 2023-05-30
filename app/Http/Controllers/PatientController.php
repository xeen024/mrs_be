<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\PersonalInformation;
use App\Models\Patient;
use App\Models\User;
use App\Models\PatientMedicalRecord;
use DB;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function createPatient(Request $request){
        // return $request;
        $address = new Address; 
        $patient = new Patient; 
        $personal_info = new PersonalInformation;
        
        $address_id = $address->createAddress($request);
        $personal_info_id = $personal_info->createPersonalInfo($request);

        $request['address_id'] = $address_id;
        $request['personal_info_id'] = $personal_info_id;

        $patient_data = $patient->addPatient($request);

        return [
            'success' => true,
            'result' => $patient_data
        ];
    }

    public function updatePatient(Request $request){
        $address = new Address; 
        $patient = new Patient; 
        $personal_info = new PersonalInformation;

        $address->updateAddress($request);
        $patient->updatePatientData($request);
        $personal_info->updatePersonalInfo($request);
        
        return [
            'success' => true,
            'result' => $request->patient_id
        ];
    }

    public function getPatientById($id){
        $patient_data = Patient::find($id);
        $personal_info_data = PersonalInformation::find($patient_data->personal_info_id);
        $address_data = Address::find($patient_data->address_id);
        if (!$patient_data) {
            return [
                'success' => false,
                'result' => []
            ];
        }
        
        return [
            'success' => true,
            'result' => [
                'patient_data' => $patient_data,
                'personal_info_data' => $personal_info_data,
                'address_data' => $address_data
            ]
        ];
    }

    public function getAllPatients(){
        $patient = new Patient;

        $get_all_data = $patient->getAllPatients();

        return [
            'success' => true,
            'results' => $get_all_data
        ];
    }

    public function countPatientsPerBrgy(){
        $barangays = ['Busaon','Carugmanan', 'Gastav', 'Kalawaig', 'Kiaring','Malagap','Malinao','Miguel Macasarte','Pantar',
        'Paradise','Pinamulaan','Poblacion I','Poblacion II','Puting-bato','Salama','Thailand','Tinimbacan','Tumbao-Camalig','Wadya'];

        $labels = [];
        $count_of_brgys = [];
        
        foreach ($barangays as $brgy) {
            $no_of_brgy = DB::table('patients')->select('patients.id','patients.address_id')
                                        ->join('addresses', 'addresses.id', 'patients.address_id')
                                        ->where('addresses.brgy', $brgy)
                                        ->get();
            $no_of_brgy = $no_of_brgy->count();
            $labels[] = (string)$brgy;
            $count_of_brgys[] = $no_of_brgy;
        }
        
        $no_of_patients = Patient::count();
        $no_of_medical_records = PatientMedicalRecord::count();
        $no_of_users = User::count();

        return [
            'success' => true,
            'result' => [
                'labels' => $labels,
                'count_of_brgys' => $count_of_brgys,
                'no_of_patients' => $no_of_patients,
                'no_of_users' => $no_of_users,
                'no_of_medical_records' => $no_of_medical_records
            ]
        ];
    }

    public function searchPatient($search_data){
        $patient = new Patient;

        $get_all_data = $patient->search($search_data);

        return [
            'success' => true,
            'results' => $get_all_data
        ];
    }
}
