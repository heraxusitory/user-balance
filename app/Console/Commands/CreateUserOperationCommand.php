<?php

namespace App\Console\Commands;

use App\Helpers\ConvertHelper;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Console\Command;

class CreateUserOperationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:operation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user operation';

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
     * @throws \Exception
     */
    public function handle()
    {
        $user_emails = User::query()->pluck('email');
        if (empty($user_emails)) {
            $this->error('No users available');
            return 0;
        }
        $user_email = $this->choice(
            'Select user',
            $user_emails->toArray()
        );
        $user = User::query()->firstWhere('email', $user_email);

        $user_balances = $user->balances;
        dump($user_balances);
        if ($user_balances->isEmpty()) {
            $this->error('No user balances available');
            return 0;
        }

        $user_balance_id = $this->choice(
            'Select balance id',
            $user_balances->pluck('id')->toArray()
        );

        $user_balance = $user_balances->find($user_balance_id);


        $operation_type = $this->choice(
            'Select operation type',
            Operation::TYPES()
        );

        $vat_rate = $this->choice(
            'Select vat rate',
            [
                1, 1.2, 1.8,
            ]
        );

        $is_vat_inclusive = $this->confirm('Is vat rate inclusive', true);

        $transaction_amount = (float)$this->ask('Enter transaction amount', 100);

        $amounts = $this->getAmounts($transaction_amount, $vat_rate, $is_vat_inclusive);

        if (in_array($operation_type, [Operation::TYPE_SUBSCRIPTION_PAYMENT(), Operation::TYPE_PAYOUT()])) {
            while ($user_balance->amount < $transaction_amount) {
                $this->error('Transaction amount should be less or equal user balance');
                $transaction_amount = $this->ask('Enter transaction amount', 100);
                $amounts = $this->getAmounts($transaction_amount, $vat_rate, $is_vat_inclusive);
            }

            $rand_key_status = array_rand(Operation::STATUSES());

            $user_balance->amount -= $amounts['amount_total'];

        } elseif (in_array($operation_type, [Operation::TYPE_TOP_UP()])) {
            $rand_key_status = array_rand(Operation::STATUSES());

            $user_balance->amount += $amounts['amount_total'];

        } else throw new \Exception('Server error');

        $operation = $user_balance->operations()->create([
            'amount' => $amounts['amount'],
            'amount_total' => $amounts['amount_total'],
            'amount_total_usd' => ConvertHelper::convertToUsd($user_balance->currency, $transaction_amount),
            'status' => Operation::STATUSES()[$rand_key_status],
            'vat_rate' => $vat_rate,
            'is_vat_inclusive' => $is_vat_inclusive,
            'type' => $operation_type,
            'currency' => $user_balance->currency,
        ]);

        if ($operation->status === Operation::SUCCEEDED_STATUS())
            $user_balance->push();

        $this->info("Operation with id: $operation->id was created successfully!");


        return 0;
    }

    public function getAmounts($transaction_amount, $vat_rate, $is_vat_inclusive): array
    {
        if ($is_vat_inclusive) {
            $amount_total = $transaction_amount;
            $amount = number_format(($transaction_amount / $vat_rate), 2, '.', '');
        } else {
            $amount_total = number_format(($transaction_amount * $vat_rate), 2, '.', '');
            $amount = $transaction_amount;
        }

        return [
            'amount' => $amount,
            'amount_total' => $amount_total,
        ];
    }
}
