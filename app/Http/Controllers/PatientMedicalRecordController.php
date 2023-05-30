<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\PersonalInformation;
use App\Models\PatientMedicalRecord;
use App\Models\Patient;

use Illuminate\Http\Request;

class PatientMedicalRecordController extends Controller
{
    //
    public function createMedRecord(Request $request){
        // return $request;
        $med_record = New PatientMedicalRecord;
        $med_record_data = $med_record->addMedRecord($request);

        return [
            'success' => true,
            'result' => $med_record_data
        ];
    }

    public function updateMedRecord(Request $request){
        $med_record = New PatientMedicalRecord;
        $med_record_data = $med_record->updateMedRecord($request);

        return [
            'success' => true,
            'result' => $med_record_data
        ];
    }

    public function getMedRecordById($id){
        $record_data = PatientMedicalRecord::find($id);
        $patient = Patient::find($record_data->id);

        if (!$record_data) {
            return [
                'success' => false,
                'result' => $record_data
            ];
        }
        
        return [
            'success' => true,
            'result' => $record_data
        ];
    }

    public function getAllMedRecords(){
        $med_record = New PatientMedicalRecord;
        $all_records = $med_record->getAllData();
        return [
            'success' => true,
            'result' => $all_records
        ];
    }

    public function getAllPatienMedRecordsById($id){
        $records = PatientMedicalRecord::where('patient_id',$id)->orderBy('id', 'desc')->get();

        // return $records;
        $all_records = [];
        foreach ($records as $rec) {
            $all_records[] = [
                'id' => $rec->id,
                'date_time' => $rec->date_time,
                'type' => $rec->type,
                'status' => $rec->status,
            ];
        }

        return [
            'success' => true,
            'result' => $all_records
        ];

    }
}
