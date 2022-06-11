<?php

use App\Events\ChatPusherEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AgentController;
use App\Http\Controllers\User\DateController;
use App\Http\Controllers\User\DateRatingController;
use App\Http\Controllers\User\LevelController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TopicController;
use App\Http\Controllers\User\UserController;
use App\Http\Requests\Chat\ParticipantAddRequest;
use App\Http\Requests\PusherChatRequest;
use App\Models\Chat;
use App\Models\ChatGroup;
use App\Models\ChatImage;
use App\Models\Notification;
use App\Models\ParticipantChat;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Notifications\FirebaseNotifications;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
});

Route::prefix('user')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);

        Route::post('/signin', [AuthController::class, 'signin']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    Route::prefix('chat')->group(function () {
        Route::group(['middleware' => ['auth:sanctum', 'banned', 'chat']], function () {
            Route::post('/', function (PusherChatRequest $request) {
                $chat = Chat::create([
                    'content' => $request->contents,
                    'user_id' => auth()->id(),
                    'chat_group_id' => (int) $request->chat_group_id,
                ]);

                foreach (ParticipantChat::where('chat_group_id', $request->chat_group_id)->get() as $item) {
                    if (auth()->id() != $item->user_id) {
                        event(new ChatPusherEvent($request, $item, auth()->id(), auth()->user()->feature_image_path, $chat->images));
                    }
                    Notification::sendNotificationFirebase($item->user_id, $request->chat_group_id, $request->contents);
                }

                return response()->json($chat);
            });

            Route::post('/image', function (PusherChatRequest $request) {

                $chat = Chat::create([
                    'user_id' => auth()->id(),
                    'content' => $request->contents,
                    'chat_group_id' => (int) $request->chat_group_id,
                ]);

                if ($request->hasFile('feature_images')) {
                    foreach ($request->file('feature_images') as $fileItem) {

                        $dataChatImageDetail = StorageImageTrait::storageTraitUploadMultiple($fileItem, 'chat');

                        ChatImage::create([
                            'image_name' => $dataChatImageDetail['file_name'],
                            'image_path' => $dataChatImageDetail['file_path'],
                            'chat_id' => $chat->id,
                        ]);
                    }
                }

                foreach (ParticipantChat::where('chat_group_id', $request->chat_group_id)->get() as $item) {
                    if (auth()->id() != $item->user_id) {
                        event(new ChatPusherEvent($request, $item, auth()->id() ,auth()->user()->feature_image_path, $chat->images));
                    }
                    Notification::sendNotificationFirebase($item->user_id, $request->chat_group_id, $request->contents);
                }

                return response()->json($chat);
            });

            Route::prefix('participant')->group(function () {

                Route::get('/', function (Request $request) {
                    $queries = ["user_id" => auth()->id()];
                    $results = RestfulAPI::response(ParticipantChat::class, $request, $queries);

                    foreach ($results as $item) {
                        $item->chatGroup;
                        $item->users = $item->users();

                        $queries = ["chat_group_id" => $item->chatGroup->id];
                        $requestMessage = $request;
                        $requestMessage->limit = 2;
                        $resultsMessage = RestfulAPI::response(Chat::class, $requestMessage, $queries);

                        foreach ($resultsMessage as $message) {
                            $message->images;
                        }
                        $item->messages = $resultsMessage;
                    }

                    return $results;
                });

                Route::get('/{id}', function (Request $request, $chatGroupId) {
                    if (empty(ParticipantChat::where('user_id', auth()->id())->where('chat_group_id', $chatGroupId)->first())) {
                        return response()->json([
                            "code" => 404,
                            "message" => "Không tìm thấy nhóm chat"
                        ], 404);
                    }

                    $queries = ["chat_group_id" => $chatGroupId];
                    $results = RestfulAPI::response(Chat::class, $request, $queries);

                    foreach ($results as $item) {
                        $item->images;
                    }
                    return $results;
                });

                Route::post('/create', function (ParticipantAddRequest $request) {
                    $chatGoup = ChatGroup::create([
                        'title' => $request->title
                    ]);

                    ParticipantChat::create(
                        [
                            'user_id' => auth()->id(),
                            'chat_group_id' => $chatGoup->id,
                        ]
                    );

                    ParticipantChat::create(
                        [
                            'user_id' => $request->getter_id,
                            'chat_group_id' => $chatGoup->id,
                        ]
                    );

                    return response()->json($chatGoup);
                });

            });
        });
    });

});
