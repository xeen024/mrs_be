<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fname = $this->ask('Enter First name');
        $lname = $this->ask('Enter Last name');
        $email = $this->ask('Enter Email');
        $password = $this->ask('Enter Password');
        $user = new User();
        $user->create([
            "name" => $fname ." ". $lname,
            "email"=> $email,
            "password"=> Hash::make($password),
            "user_type" => 'admin'
        ]);
    }
}
