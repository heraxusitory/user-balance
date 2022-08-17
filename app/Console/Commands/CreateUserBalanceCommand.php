<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserBalanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user balance to the user';

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
        $user_ids = User::query()->pluck('id');
        if (empty($user_ids)) {
            $this->error('No users available');
            return 0;
        }
        $user_id = $this->choice(
            'Select user',
            $user_ids->toArray(),
        );

        $currency = $this->choice(
            'Select currency',
            array_keys(config('currencies'))
        );
        $balance = $this->ask('Enter balance', '100');


        $user = User::query()->findOrFail($user_id);
        $user->balances()->create([
            'currency' => $currency,
            'amount' => $balance,
        ]);

        $this->info("Created balance for user_id: $user_id, currency: $currency and balance: $balance");

        return 0;
    }
}
