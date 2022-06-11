<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Formatter;
use App\Models\RestfulAPI;
use App\Models\TopicQuestionProfileCandidate;
use App\Models\TopicQuestionProfileDating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DateController extends Controller
{
    public function list(Request $request){
        $queries= [];
        if (isset($request->date_status_id)){
            $queries = ["date_status_id" => $request->date_status_id];
        }

        $query = RestfulAPI::responseCustomResult(Date::class , $request,$queries);
        $query = $query->where(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhere('agent_id', auth()->id())
                ->orWhere('candidate_id', auth()->id());
        });

        $items = $query->latest()->paginate( (int) filter_var($request->limit ?? '10', FILTER_SANITIZE_NUMBER_INT))->appends(request()->query());

        foreach ($items as $item){
            $item->finder;
            $item->candidate;
            optional($item->candidate)->identificationImages;
            $item->agent;

            $request->limit = Formatter::getLimitRequest();
            $questions = RestfulAPI::response(TopicQuestionProfileCandidate::class , $request);
            foreach ($questions as $itemQuestion){
                $answers = [];
                foreach(auth()->user()->topicQuestionProfileCandidateUser(auth()->id(), $itemQuestion->id) as $question){
                    $answers[] = $question->questionProfileDating;
                }
                $itemQuestion['answers'] = $answers;
            }
            $item->candidate['questions'] = $questions;
        }
        return $items;
    }

    public function store(Request $request){
        $request->validate([
            "user_id" => 'required',
            "candidate_id" => 'required',
            "datetime_begin" => 'required',
            "address" => 'required',
        ]);

        $date = Date::create([
            'agent_id' => auth()->id(),
            'user_id' => $request->user_id,
            'candidate_id' => $request->candidate_id,
            'datetime_begin' => $request->datetime_begin,
            'address' => $request->address,
        ]);

        return $date;
    }

    public function update(Request $request, $id){

        $date = Date::find($id);

        if (empty($date) || !($date->agent_id == auth()->id() || $date->user_id == auth()->id() || $date->candidate_id == auth()->id())){
            return response()->json([
                'message' => 'Không tìm thấy date',
                'code' => 404
            ], 404);
        }

        $dataUpdate = [];

        if (isset($request->date_status_id)){
            $dataUpdate['date_status_id'] = $request->date_status_id;
        }

        if (isset($request->date_user_status_id)){
            if (auth()->user()->role_id == 4){
                $dataUpdate['date_user_status_id'] = $request->date_user_status_id;
            }else{
                $dataUpdate['date_agent_status_id'] = $request->date_user_status_id;
            }
        }

        if (isset($request->datetime_begin)){
            $dataUpdate['datetime_begin'] = $request->datetime_begin;
        }

        $date->update($dataUpdate);

        $date = Date::find($id);

        return response()->json($date);
    }

}
