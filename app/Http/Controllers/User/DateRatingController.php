<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\DateRating;
use App\Models\Formatter;
use App\Models\RestfulAPI;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DateRatingController extends Controller
{

    public function get(Request $request, $id){
        $queries = ["date_id" => $id];
        return RestfulAPI::response(DateRating::class , $request, $queries);
    }

    public function store(Request $request){

        $request->validate([
            "date_id" => 'required',
            "star" => 'required',
        ]);

        $dateRating = DateRating::firstOrCreate([
            'date_id' => $request->date_id,
            'user_id' => auth()->id(),
        ],[
            'date_id' => $request->date_id,
            'star' => $request->star,
            'message' => $request->message,
            'user_id' => auth()->id(),
        ]);

        return $dateRating;
    }

}
