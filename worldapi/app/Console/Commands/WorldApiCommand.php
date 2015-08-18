<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WorldApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worldapi:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the World API tables';

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
        $countries = \App\Country::all();

        foreach($countries as $country){
            echo "DB::table('country')->insert(['cc_fips' => '{$country->cc_fips}','cc_iso' => '{$country->cc_iso}','cc_tld' => '{$country->cc_tld}','country_name' => '{$country->country_name}',]); \n";
        }
    }
}
