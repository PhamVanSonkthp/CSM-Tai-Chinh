<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Lend extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function IDLend(){
        return Formatter::getOnlyDate($this->created_at) . "_" . $this->id;
    }

    public function admin(){
        return $this->hasOne(User::class, 'id','admin_id');
    }

    public function lendStatus(){
        return $this->hasOne(LendStatus::class, 'id','lend_status_id');
    }

    public function marriedStatus(){
        return $this->hasOne(MarriedStatus::class, 'id','married_status_id');
    }

    public function educationLevel(){
        return $this->hasOne(EducationLevel::class, 'id','education_level_id');
    }

    public function middleIncome(){
        return $this->hasOne(MiddleIncome::class, 'id','middle_income_id');
    }

    public function bank(){
        return $this->hasOne(Bank::class, 'id','bank_id');
    }

    public function lendImages(){
        return $this->hasMany(LendImage::class, 'lend_id','id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function purposeReject(){
        return $this->hasOne(PurposeReject::class, 'id','purpose_reject_id');
    }
}
