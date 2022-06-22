<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use function view;

class AdminNotificationController extends Controller
{
    use DeleteModelTrait;
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function index()
    {
        Notification::whereNull('read_at')->update([
            'read_at' => now()
        ]);

        $notifications = $this->notification->latest()->paginate(10)->appends(request()->query());

        return view('administrator.notification.index' , compact('notifications'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->notification);
    }
}
