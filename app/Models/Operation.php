<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Operation extends Model
{
    protected $table = 'user_operations';

    protected $guarded = [];

    private const TYPE_SUBSCRIPTION_PAYMENT = 'subscription_payment';
    private const TYPE_TOP_UP = 'top_up';
    private const TYPE_PAYOUT = 'payout';

    public static function TYPE_SUBSCRIPTION_PAYMENT()
    {
        return self::TYPE_SUBSCRIPTION_PAYMENT();
    }

    public static function TYPE_TOP_UP()
    {
        return self::TYPE_TOP_UP();
    }

    public static function TYPE_PAYOUT()
    {
        return self::TYPE_PAYOUT();
    }
}
