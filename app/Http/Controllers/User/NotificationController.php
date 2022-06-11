<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use function view;

class NotificationController extends Controller
{
    use DeleteModelTrait;
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function index()
    {
        $this->notification->where('notifiable_id' , auth()->id())->whereNull('read_at')->update([
            'read_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        $notifications = $this->notification->where('notifiable_id' , auth()->id())->latest()->paginate(10);
        return view('user.notification.index' , compact('notifications'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->notification);
    }
}
