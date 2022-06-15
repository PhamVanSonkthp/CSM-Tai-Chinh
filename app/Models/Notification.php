<?php

namespace App\Models;

use App\Notifications\FirebaseNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Notification extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'notifiable_id');
    }

    public static function createNotification($user_id, $title, $content)
    {
        Notification::create([
            'notifiable_id' => $user_id,
            'title' => $title,
            'content' => $content,
        ]);
    }
}
