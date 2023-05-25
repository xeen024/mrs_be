<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PatientMedicalRecord extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function addMedRecord($data){
        $med_record_data = PatientMedicalRecord::create([
             'patient_id' => $data->patient_id,
             'date_time' => Carbon::now(),
             'bp' => $data->bp,
             'phic_no' => $data->phic_no,
             'type' => $data->type,
             'weight' => $data->weight,
             'height' => $data->height,
             'bmi' => $data->bmi,
             'waist' => $data->waist,
             'is_pedia' => $data->is_pedia,
             'abd_circ' => $data->abd_circ,
             'head_circ' => $data->head_circ,
             'cc' => $data->cc,
             'hpi' => $data->hpi,
             'temp' => $data->temp,
             'pr' => $data->pr,
             'rr' => $data->rr,
             'on_going_meds' => $data->on_going_meds,
             'pe' => $data->pe,
             'assessment' => isset($data->assessment) ? $data->assessment : null,
             'plan_diagnostics' => isset($data->plan_diagnostics) ? $data->plan_diagnostics : null,
             'medications' => isset($data->medications) ? $data->medications : null,
             'status' => 'PENDING'
        ]);
 
        return $med_record_data->id;
    }

    public function updateMedRecord($data){
        $med_record_data = PatientMedicalRecord::updateOrCreate([
            'id' => $data->id
        ],[
            'patient_id' => $data->patient_id,
            'doctor_id' => $data->doctor_id,
            'bp' => $data->bp,
            'weight' => $data->weight,
            'height' => $data->height,
            'bmi' => $data->bmi,
            'waist' => $data->waist,
            'is_pedia' => $data->is_pedia,
            'abd_circ' => $data->abd_circ,
            'head_circ' => $data->head_circ,
            'cc' => $data->cc,
            'hpi' => $data->hpi,
            'temp' => $data->temp,
            'pr' => $data->pr,
            'rr' => $data->rr,
            'on_going_meds' => $data->on_going_meds,
            'pe' => $data->pe,
            'assessment' => $data->assessment,
            'plan_diagnostics' => $data->plan_diagnostics,
            'medications' => $data->medications,
            'status' => $data->status
       ]);

       return $med_record_data->id;
    }

    public function getAllData(){
        $all_records = PatientMedicalRecord::all();

        return $all_records;
    }
}
