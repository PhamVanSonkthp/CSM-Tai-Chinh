<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Formatter;
use App\Models\ProfilePairingUser;
use App\Models\ProfileRequireUser;
use App\Models\QuestionProfileDating;
use App\Models\QuestionProfilePairing;
use App\Models\QuestionProfileRequire;
use App\Models\RestfulAPI;
use App\Models\TopicQuestionProfileDating;
use App\Models\TopicQuestionProfileDatingUser;
use App\Models\TopicQuestionProfilePairing;
use App\Models\TopicQuestionProfilePairingUser;
use App\Models\TopicQuestionProfileRequire;
use App\Models\TopicQuestionProfileRequireUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function getYourself(Request $request){
        return auth()->user();
    }

    public function getDating(Request $request){

        $request->limit = Formatter::getLimitRequest();
        $items = RestfulAPI::response(TopicQuestionProfileDating::class , $request);
        foreach ($items as $item){
            $answers = [];
            foreach(auth()->user()->topicQuestionProfileDatingUser(auth()->id(), $item->id) as $question){
                $answers[] = $question->questionProfileDating;
            }
            $item['answers'] = $answers;
        }

        return $items;
    }

    public function getDatingAnswerByTopicId(Request $request, $id){
        $queries = ["topic_question_profile_dating_id" => $id];
        $request->limit = Formatter::getLimitRequest();
        return RestfulAPI::response(QuestionProfileDating::class , $request, $queries);
    }

    public function updateDatingAnswer(Request $request){

        if (isset($request->question_profile_dating_ids) && is_array($request->question_profile_dating_ids) && count($request->question_profile_dating_ids) > 0){
            $params = $request->question_profile_dating_ids;
            $question_profile_dating = QuestionProfileDating::find($params[0]);

            $question_profile_datings = QuestionProfileDating::where('topic_question_profile_dating_id', $question_profile_dating->topic_question_profile_dating_id)->get();

            $idsNeedDelete=[];
            foreach ($question_profile_datings as $item){
                $idsNeedDelete[] = $item->id;
            }

            TopicQuestionProfileDatingUser::where('user_id', auth()->id())->whereIn('question_profile_dating_id' , $idsNeedDelete)->delete();

            foreach ($params as $item){
                TopicQuestionProfileDatingUser::create([
                    'user_id' => auth()->id(),
                    'question_profile_dating_id' => $item,
                ]);
            }
        }

        return response()->json([
            'message' => 'success',
            'code' => 200,
        ]);
    }

    public function getLover(Request $request){

        $profilePairingUser = null;

        $profilePairingUser = ProfilePairingUser::where('user_id', auth()->id())->first();

        if (empty($profilePairingUser)){
            $profilePairingUser['user_id'] = auth()->id();
            $profilePairingUser['name'] = "";
            $profilePairingUser['height'] = 0;
            $profilePairingUser['weight'] = 0;
            $profilePairingUser['job'] = "";
            $profilePairingUser['job_title'] = "";
            $profilePairingUser['pet_title'] = null;
            $profilePairingUser['topic_of_interest'] = null;
            $profilePairingUser['feature_image_name'] = "";
            $profilePairingUser['feature_image_path'] = "";
            $profilePairingUser['status'] = "";
            $profilePairingUser['require_finder'] = "";
        }

        $request->limit = Formatter::getLimitRequest();
        $items = RestfulAPI::response(TopicQuestionProfilePairing::class , $request);
        foreach ($items as $item){
            $answers = [];
            foreach(auth()->user()->topicQuestionProfilePairingUser(auth()->id(), $item->id) as $question){
                $answers[] = $question->questionProfilePairing;
            }
            $item['answers'] = $answers;
        }

        $profilePairingUser['data_questions'] = $items;
        return $profilePairingUser;
    }

    public function getLoverAnswerByTopicId(Request $request, $id){
        $queries = ["topic_question_profile_pairing_id" => $id];
        $request->limit = Formatter::getLimitRequest();
        return RestfulAPI::response(QuestionProfilePairing::class , $request, $queries);
    }

    public function updateLoverAnswer(Request $request){

        if (isset($request->data_questions) && isset($request->data_questions['question_profile_pairing_ids']) && is_array($request->data_questions['question_profile_pairing_ids']) && count($request->data_questions['question_profile_pairing_ids']) > 0){
            $params = $request->data_questions['question_profile_pairing_ids'];
            $question_profile_pairing = QuestionProfilePairing::find($params[0]);

            $question_profile_pairings = QuestionProfilePairing::where('topic_question_profile_pairing_id', $question_profile_pairing->topic_question_profile_pairing_id)->get();

            $idsNeedDelete=[];
            foreach ($question_profile_pairings as $item){
                $idsNeedDelete[] = $item->id;
            }

            TopicQuestionProfilePairingUser::where('user_id', auth()->id())->whereIn('question_profile_pairing_id' , $idsNeedDelete)->delete();

            foreach ($params as $item){
                TopicQuestionProfilePairingUser::create([
                    'user_id' => auth()->id(),
                    'question_profile_pairing_id' => $item,
                ]);
            }
        }

        if (isset($request->data_profile)){

            $dataUpdateProfile = [
                'name' => $request->data_profile['name'],
                'height' => $request->data_profile['height'],
                'weight' => $request->data_profile['weight'],
                'job' => $request->data_profile['job'],
                'job_title' => $request->data_profile['job_title'],
                'pet_title' => isset($request->data_profile['pet_title']) ? $request->data_profile['pet_title'] : "",
                'topic_of_interest' => isset($request->data_profile['topic_of_interest']) ? $request->data_profile['topic_of_interest'] :"",
                'feature_image_name' => isset($request->data_profile['feature_image_name']) ? $request->data_profile['feature_image_name'] : "",
                'feature_image_path' => isset($request->data_profile['feature_image_path']) ? $request->data_profile['feature_image_path'] : "",
                'status' => $request->data_profile['status'],
                'require_finder' => $request->data_profile['require_finder'],
            ];

            ProfilePairingUser::where('user_id', auth()->id())->updateOrCreate([
                'user_id' => auth()->id()
            ],$dataUpdateProfile);
        }

        return response()->json([
            'message' => 'success',
            'code' => 200,
        ]);
    }

    public function getRequire(Request $request){

        $profileRequireUser = null;

        $profileRequireUser = ProfileRequireUser::where('user_id', auth()->id())->first();

        if (empty($profileRequireUser)){
            $profileRequireUser['user_id'] = auth()->id();
            $profileRequireUser['love_meaning'] = "";
        }

        $request->limit = Formatter::getLimitRequest();
        $items = RestfulAPI::response(TopicQuestionProfileRequire::class , $request);
        foreach ($items as $item){
            $answers = [];
            foreach(auth()->user()->topicQuestionProfileRequireUser(auth()->id(), $item->id) as $question){
                $answers[] = $question->questionProfileRequire;
            }
            $item['answers'] = $answers;
        }

        $profileRequireUser['data_questions'] = $items;
        return $profileRequireUser;
    }

    public function getRequireAnswerByTopicId(Request $request, $id){
        $queries = ["topic_question_profile_require_id" => $id];
        $request->limit = Formatter::getLimitRequest();
        return RestfulAPI::response(QuestionProfileRequire::class , $request, $queries);
    }

    public function updateRequireAnswer(Request $request){

        if (isset($request->data_questions) && isset($request->data_questions['question_profile_require_ids']) && is_array($request->data_questions['question_profile_require_ids']) && count($request->data_questions['question_profile_require_ids']) > 0){
            $params = $request->data_questions['question_profile_require_ids'];
            $question_profile_require = QuestionProfileRequire::find($params[0]);

            $question_profile_requires = QuestionProfileRequire::where('topic_question_profile_require_id', $question_profile_require->topic_question_profile_require_id)->get();

            $idsNeedDelete=[];
            foreach ($question_profile_requires as $item){
                $idsNeedDelete[] = $item->id;
            }

            TopicQuestionProfileRequireUser::where('user_id', auth()->id())->whereIn('question_profile_require_id' , $idsNeedDelete)->delete();

            foreach ($params as $item){
                TopicQuestionProfileRequireUser::create([
                    'user_id' => auth()->id(),
                    'question_profile_require_id' => $item,
                ]);
            }
        }

        if (isset($request->data_profile)){

            $dataUpdateProfile = [
                'love_meaning' => $request->data_profile['love_meaning'],
            ];

            ProfileRequireUser::where('user_id', auth()->id())->updateOrCreate([
                'user_id' => auth()->id()
            ],$dataUpdateProfile);
        }

        return response()->json([
            'message' => 'success',
            'code' => 200,
        ]);
    }

}
