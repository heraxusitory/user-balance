<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'user_balances';

    protected $fillable = [
        'amount',
        'currency',
    ];
}
