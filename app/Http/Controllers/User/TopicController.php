<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Formatter;
use App\Models\RestfulAPI;
use App\Models\Topic;
use App\Models\TopicComment;
use App\Models\TopicGim;
use App\Models\TopicQuestionProfileCandidate;
use App\Models\TopicQuestionProfileDating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TopicController extends Controller
{
    public function list(Request $request){
        $queries = ["user_id" => auth()->id()];
        $items =  RestfulAPI::response(Topic::class , $request, $queries);

        foreach ($items as $item){
            $item['number_user'] = $item->numberUser();
        }

        return $items;

    }

    public function listGim(Request $request){
        $queries = ["user_id" => auth()->id()];
        $items = RestfulAPI::response(TopicGim::class , $request, $queries);

        return $items;

    }

    public function listComment(Request $request, $id){
        $queries = ["topic_id" => $id];
        $items = RestfulAPI::response(TopicComment::class , $request, $queries);

        foreach ($items as $item){
            $item->user;
        }

        return $items;
    }

    public function store(Request $request){
        $request->validate([
            "name" => 'required',
            "decription" => 'required',
        ]);

        $item = Topic::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'decription' => $request->decription,
        ]);

        return $item;
    }

    public function createComment(Request $request, $id){
        $request->validate([
            "decription" => 'required',
        ]);

        $item = TopicComment::create([
            'topic_id' => $id,
            'user_id' => auth()->id(),
            'decription' => $request->decription,
        ]);
        $item = $item->fresh();
        return $item;
    }

    public function createGim(Request $request){
        $request->validate([
            "topic_id" => 'required',
        ]);

        $item = TopicGim::firstOrCreate([
            'topic_id' => $request->topic_id,
            'user_id' => auth()->id(),
        ]);
        $item = $item->fresh();
        return $item;
    }

    public function deleteGim(Request $request, $id){

        $topicGim = TopicGim::find($id);

        if(!empty($topicGim) && $topicGim->user_id == auth()->id()){
            $topicGim->delete();
        }

        return response()->json([
            'message' => "success",
            "code" => 200,
        ]);
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

        $date->update($dataUpdate);

        return response()->json([
            'message' => 'success',
            'code' => 200
        ]);
    }

}
