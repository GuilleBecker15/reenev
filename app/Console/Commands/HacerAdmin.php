<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class HacerAdmin extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hacer:admin {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite hacer admin a un user';

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
        $user = User::find($this->argument('id'));
        
        if ($user) {

            $user->supervisor = -1;
            $user->esAdmin = true;
            $user->save();
            $this->info("'".$user->name1."' ahora es admin categoria 1");

        } else {
        
            $this->error("No existe un user con id '".$this->argument('id')."'");
        
        }
    
    }

}
