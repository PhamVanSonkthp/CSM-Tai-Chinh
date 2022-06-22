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

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    function handleMoneyTenor($numMonth, $indexTenor, $lend_money) {

        $quaInterest = 0.01;

        $valueInput = $lend_money;

        if ($indexTenor == 0) {
            $numInterMonth = $valueInput * $quaInterest * $numMonth;
            $resultMoney = ($valueInput + $numInterMonth) / $numMonth;

//            $MoneyMonthFirst = new Intl.NumberFormat("vn").format(
//                    resultMoney.toFixed()
//                );
            return $resultMoney;
            // console.log(MoneyMonthFirst, "Tháng đầu");
        } else {
            $numMonthly = $valueInput / $numMonth;
            $moneyMothNext = $valueInput - $numMonthly * $indexTenor;
            $numInterestTenor =
                ($moneyMothNext * ($quaInterest * $numMonth)) / $numMonth;

            $totalFinal = $numMonthly + $numInterestTenor;

            // console.log(totalFinal, `Tháng ${indexTenor}`);
            return $totalFinal;
        }
    }

    public function lendImages(){
        return $this->hasMany(LendIdentityImage::class, 'lend_id', 'id');
    }

    public function detail(){
        $month = Formatter::getDateCustom($this->created_at , 'm');

        $day = Formatter::getDateCustom($this->created_at , 'd');
        $templateDetails = [];
        for ($i = 0; $i < $this->interval; $i++) {
            $priceValue = $this->handleMoneyTenor($this->interval, $i, $this->lend_money );

            $templateDetails[] = [
                'num' => $i + 1,
                'money' => $priceValue,
                'date' => $day . ' - ' . (++$month % 12 == 0 ? 12 : $month % 12),
            ];
        }

        return $templateDetails;
    }
}
