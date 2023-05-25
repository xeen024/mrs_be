<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; 
use App\Models\Doctor; 
use App\Models\RecordKeeper; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function addUser($data){
        $user_data = User::create([
            'name' => ucfirst($data->firstname)." ".ucfirst($data->lastname),
            'password'=> Hash::make($data->password),
            'email' => $data->email,
            'user_type' => $data->user_type
        ]);

        switch ($data->type) {
            case 'admin':
                Admin::create([
                    'user_id' => $user_data->id,
                ]);
                break;
            case 'doctor':
                Doctor::create([
                    'user_id' => $user_data->id,
                ]);
                break;
            case 'record_keeper':
                RecordKeeper::create([
                    'user_id' => $user_data->id,
                ]);
                break;
            default:
                # code...
                break;
        }

        return $user_data;
    }
}
