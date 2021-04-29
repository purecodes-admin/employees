<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add admin in userbase';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name=$this->ask('Plz Enter your name here');
        $email=$this->ask('Plz Enter Your email');
        $password = $this->ask('Plz Enter Your Password');
        

        $user= new User;
        $user->name=$name;
        $user->email= $email;
        $user->email_verified_at= now();
        $user->password = Hash::make($password);
        $user->set_as = 1;
        $user->save();
        return'Admin Added Successfully!';
    }
}
