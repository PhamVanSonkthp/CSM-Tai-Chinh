<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Formatter extends Model
{
    use HasFactory;

    public static function getLimitRequest(){
        return 1000;
    }

    public static function getOnlyDate($input){
        try {
            return date('d/m/Y', strtotime($input));
        }catch (\Exception $exception){
            return null;
        }
    }

    public static function getOnlyTime($input){
        try {
            return date('H:i', strtotime($input));
        }catch (\Exception $exception){
            return null;
        }
    }

    public static function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
}
