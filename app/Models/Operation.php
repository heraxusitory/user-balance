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

    private const PENDING_STATUS = 'pending';
    private const FAILED_STATUS = 'failed';
    private const SUCCEEDED_STATUS = 'succeeded';
    private const CANCELLED_STATUS = 'cancelled';

    public static function STATUSES()
    {
        return [
            self::PENDING_STATUS,
            self::FAILED_STATUS,
            self::SUCCEEDED_STATUS,
            self::CANCELLED_STATUS,
        ];
    }

    public static function TYPES()
    {
        return [
            self::TYPE_SUBSCRIPTION_PAYMENT,
            self::TYPE_TOP_UP,
            self::TYPE_PAYOUT
        ];
    }

    public static function TYPE_SUBSCRIPTION_PAYMENT()
    {
        return self::TYPE_SUBSCRIPTION_PAYMENT;
    }

    public static function TYPE_TOP_UP()
    {
        return self::TYPE_TOP_UP;
    }

    public static function TYPE_PAYOUT()
    {
        return self::TYPE_PAYOUT;
    }

    public static function PENDING_STATUS()
    {
        return self::PENDING_STATUS;
    }

    public static function FAILED_STATUS()
    {
        return self::FAILED_STATUS;
    }

    public static function SUCCEEDED_STATUS()
    {
        return self::SUCCEEDED_STATUS;
    }

    public static function CANCELLED_STATUS()
    {
        return self::CANCELLED_STATUS;
    }
}
