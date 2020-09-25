<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Data from APIs';

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
        Log::channel('daily')->info('Call API running');
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'coronavirus-us-api.p.rapidapi.com',
            'x-rapidapi-key' => '39f9bc0c33mshed4a3af8b0e5ce7p1a0857jsnbf942780036b'
        ])->get('https://coronavirus-us-api.p.rapidapi.com/api/country/latest');
        Log::channel('daily')->info($response->status());

        return $response;
    }
}
