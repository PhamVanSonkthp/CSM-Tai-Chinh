<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AddressBornUser;
use App\Models\Date;
use App\Models\Formatter;
use App\Models\ProfileRequireUser;
use App\Models\QuestionProfileCandidate;
use App\Models\QuestionProfilePairing;
use App\Models\QuestionProfileRequire;
use App\Models\RestfulAPI;
use App\Models\TopicQuestionProfileCandidate;
use App\Models\TopicQuestionProfileCandidateUser;
use App\Models\TopicQuestionProfileRequireUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function finderNeedHelp(Request $request){
        $queries = ["user_suggestion_id" => 1 , "role_id" => 4];

        if (isset($request->gender_id) && !empty($request->gender_id)){
            $queries["gender_id"] = $request->gender_id;
        }

        if (isset($request->address_born_id) && !empty($request->address_born_id)){
            $queries["address_born_id"] = $request->address_born_id;
        }

        $query = RestfulAPI::responseCustomResult(User::class , $request, $queries, true);

        if (isset($request->date_of_birth) && !empty($request->date_of_birth)){
            $query = $query->whereYear('date_of_birth', $request->date_of_birth);
        }

        if (isset($request->job) && !empty($request->job)){
            $query = $query->where('job', 'like',  '%'. $request->job.'%' );
        }

        return $query->latest()->paginate( (int) filter_var($request->limit ?? '10', FILTER_SANITIZE_NUMBER_INT))->appends(request()->query());
    }

    public function finderNeedHelpTopicQuestion(Request $request){

        if (isset($request->question_id)){
            if ($request->question_id == 1){
                $request->limit = Formatter::getLimitRequest();
                return RestfulAPI::response(AddressBornUser::class, $request);
            }
            if ($request->question_id == 2){
                $queries = ["topic_question_profile_pairing_id" => 1];
                $request->limit = Formatter::getLimitRequest();
                return RestfulAPI::response(QuestionProfilePairing::class , $request, $queries);
            }
            if ($request->question_id == 3){
                $queries = ["topic_question_profile_pairing_id" => 3];
                $request->limit = Formatter::getLimitRequest();
                return RestfulAPI::response(QuestionProfilePairing::class , $request, $queries);
            }
        }

        return response()->json([
            "message" => "question_id is required",
            "code" => 400,
        ],400);
    }

    public function listCandidate(Request $request){
        $queries = ["parent_id" => auth()->id()];
        return RestfulAPI::response(User::class , $request, $queries);
    }

    public function getCandidate(Request $request, $id){
        $candidate = User::where(["parent_id" => auth()->id() , 'id' => $id])->first();
        if(!empty($candidate)){
            $candidate->identificationImages;
        }
        return $candidate;
    }

    public function listCandidateQuestion(Request $request){
        $request->limit = Formatter::getLimitRequest();
        return RestfulAPI::response(TopicQuestionProfileCandidate::class , $request);
    }

    public function getCandidateAnswerByTopicId(Request $request, $id){
        $queries = ["topic_question_profile_candidate_id" => $id];
        $request->limit = Formatter::getLimitRequest();
        return RestfulAPI::response(QuestionProfileCandidate::class , $request, $queries);
    }

    public function storeCandidate(Request $request){
        if (isset($request->data_profile)){

            $dataCreateProfile = [
                'display_name' => $request->data_profile['display_name'],
                'real_name' => $request->data_profile['real_name'],
                'phone' => $request->data_profile['phone'],
                'date_of_birth' => $request->data_profile['date_of_birth'],
                'address_born_id' => $request->data_profile['address_born_id'],
                'gender_id' => $request->data_profile['gender_id'],
                'address_working' => $request->data_profile['address_working'],
                'university' => $request->data_profile['university'],
                'height' => $request->data_profile['height'],
                'job' => $request->data_profile['job'],
                'job_title' => $request->data_profile['job_title'],
                'topic_favorite' => $request->data_profile['topic_favorite'],
                'parent_id' => auth()->id(),
                'user_name' => auth()->id() . '-' . now(),
                'password' => auth()->id() . '-' . now(),
                'role_id' => 6,
            ];

            $candidate = User::create($dataCreateProfile);
        }else{
            return response()->json([
                'message' => 'Thiếu thông tin data_profile',
                'code' => 400
            ], 400);
        }

        if (isset($request->data_questions) && isset($request->data_questions['question_profile_candidate_ids']) && is_array($request->data_questions['question_profile_candidate_ids']) && count($request->data_questions['question_profile_candidate_ids']) > 0){
            $params = $request->data_questions['question_profile_candidate_ids'];
            $question_profile_candidate = QuestionProfileCandidate::find($params[0]);

            $question_profile_candidates = QuestionProfileCandidate::where('topic_question_profile_candidate_id', $question_profile_candidate->topic_question_profile_candidate_id)->get();

            $idsNeedDelete=[];
            foreach ($question_profile_candidates as $item){
                $idsNeedDelete[] = $item->id;
            }

            TopicQuestionProfileCandidateUser::where('user_id', auth()->id())->whereIn('question_profile_candidate_id' , $idsNeedDelete)->delete();

            foreach ($params as $item){
                TopicQuestionProfileCandidateUser::create([
                    'user_id' => $candidate->id,
                    'question_profile_candidate_id' => $item,
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Thiếu thông tin data_questions',
                'code' => 400
            ], 400);
        }

        return $candidate;

    }
}
