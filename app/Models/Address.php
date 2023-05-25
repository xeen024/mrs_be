<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createAddress($data){
       $address_data = Address::create([
            'street' => $data->street,
            'brgy' => $data->brgy,
            'city' => $data->city,
            'province' => $data->province,
            'country' => $data->country,
       ]);

       return $address_data->id;
    }

    public function updateAddress($data){
        $address_data = Address::updateOrCreate([
            'id' => $data->address_id
        ],[
             'street' => $data->street,
             'brgy' => $data->brgy,
             'city' => $data->city,
             'province' => $data->province,
             'country' => $data->country,
        ]);
 
        return $address_data->id;
     }
}
