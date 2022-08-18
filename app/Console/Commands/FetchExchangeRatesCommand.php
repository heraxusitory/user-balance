<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange_rates:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch exchange rates';

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

        $rates = json_decode(Http::get('https://api.exchangerate.host/latest?base=USD'), true);

        if (isset($rates['rates'])) {
            foreach ($rates['rates'] as $cur => $value) {
                $exch_rate = ExchangeRate::query()->updateOrCreate(['currency' => $cur,], ['rate' => $value]);
                $this->info("Save: {$cur}");
            }
        } else {
            $this->error("Unknown response: " . json_encode($rates));
            throw new \Exception("Unknown response: " . json_encode($rates));
        }

        return 0;
    }
}
