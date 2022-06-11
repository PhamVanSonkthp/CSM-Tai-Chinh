<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Lend extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = [];

    public function admin(){
        return $this->hasOne(User::class, 'id','admin_id');
    }

    public function lendStatus(){
        return $this->hasOne(LendStatus::class, 'id','lend_status_id');
    }
}
