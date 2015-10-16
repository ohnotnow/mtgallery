<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtgallery:createadmin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

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
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password1 = $this->secret('Pick a password : ');
        $password2 = $this->secret('Re-type the password to confirm : ');
        if ($password1 != $password2) {
            $this->error("Passwords did not match");
            abort(400);
        }
        $user = new User;
        $user->email = $email;
        $user->password = bcrypt($password1);
        $user->save();
        $this->info("User created with email of {$email}");
    }
}
