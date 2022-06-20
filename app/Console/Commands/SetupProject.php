<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create tables & enter data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('In the normal situation, the users who are in the attached file will be entered.');
        $loadTesting = $this->confirm('Do you want to enter data for the performance test (15,000 users)?'
            , false);

        $this->info('start setup');

        if ($loadTesting){
            $this->info('The process may take some time');
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed --class=UserTestSeeder');
        }else{
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed --class=ImageSeeder');
            Artisan::call('db:seed --class=UserSeeder');
        }

        $this->info('complete setup.');
        return Command::SUCCESS;
    }
}
