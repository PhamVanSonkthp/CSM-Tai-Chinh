<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChatPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $user_id;
    public $chat_group_id;
    public $created_at;
    public $image_link;
    public $images;
    public $sender_id;
    public $pusher_id;

    public function __construct(Request $request, $participantChat, $sender_id, $image_link, $images)
    {
        $this->content = $request->contents;
        $this->user_id = $sender_id;
        $this->pusher_id = $participantChat->user_id;
        //$this->sender_id = $sender_id;
        $this->chat_group_id = (int) $request->chat_group_id;
        $this->created_at = now();
        $this->image_link = $image_link;
        $this->images = $images;
    }

    public function broadcastOn()
    {
        return ['id-chat-pusher-' . $this->pusher_id];
    }

    public function broadcastAs()
    {
        return ('id-chat-pusher-' . $this->pusher_id);
    }

}
