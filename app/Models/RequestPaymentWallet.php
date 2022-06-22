<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RequestPaymentWallet extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = [];

    public function status(){
        return $this->hasOne(StatusRequestPaymentWallet::class, 'id','status_request_payment_wallet_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function bank(){
        return $this->hasOne(Bank::class , 'id', 'bank_id');
    }

}
