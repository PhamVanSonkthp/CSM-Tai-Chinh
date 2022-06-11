<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Notification;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use function view;

class LevelController extends Controller
{

    public function get(){

        $user = auth()->user();
        $level = $user->level();
        $user['level'] = $user->level();

        $user['number_date_current_month'] = Date::where('agent_id' , auth()->id())->whereMonth('created_at', now()->month)->count();

        $numberCandidateCurrentMonth = User::where('parent_id', auth()->id())->count();
        $numberDateActionCurrentMonth = Date::where('agent_id', auth()->id())->where('date_status_id', 5)->count();
        $numberDateLoverCurrentMonth = Date::where('agent_id', auth()->id())->where('date_status_id', 6)->count();

        $user['commission_current_month'] = ($numberCandidateCurrentMonth * $level->commission_candidate) + ($numberDateActionCurrentMonth * $level->commission_date) + ($numberDateLoverCurrentMonth * $level->commission_lover);

        return $user;
    }
}
