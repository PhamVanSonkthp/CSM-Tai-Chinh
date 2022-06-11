<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Notifications\Notifications;

class NotificationController extends Controller
{
    private $user;

    public function __construct( User $user)
    {
        $this->user = $user;
    }


    public function sendNotification(){

//        $invoices = Invoice::all();
//        foreach ($invoices as $invoiceItem) {
//            $product = $invoiceItem->product;
//
//            $user = $invoiceItem->user;
//
//            $notificationData = [
//                'body'=>'Khóa học "' . $product->name .'" của bạn sắp hết hạn, vui lòng truy cập "Khóa học của tôi" để gia hạn',
//                'text'=>'Gia hạn ngay',
//                'url'=>route('user.sources'),
//                'thankyou'=>'Cảm ơn bạn đã sử dụng dịch vụ!',
//            ];
//
//            $user->notify(new Notifications($notificationData));

//            if( $product->time_payment_again == 1 || (new DateTime($invoices->updated_at))->diff(new DateTime())->m  == 0 ){
//                $user = $invoiceItem->user();
//
//                $notificationData = [
//                    'body'=>'Khóa học "' . $product->name .'" của bạn sắp hết hạn, vui lòng truy cập "Khóa học của tôi" để gia hạn',
//                    'text'=>'Gia hạn ngay',
//                    'url'=>route('user.sources'),
//                    'thankyou'=>'Cảm ơn bạn đã sử dụng dịch vụ!',
//                ];
//
//                $user->notify(new Notifications($notificationData));
//
//            }
        //}
//        $user = $this->user->first();
//
//        $notificationData = [
//            'body'=>'a',
//            'text'=>'b',
//            'url'=>url('/'),
//            'thankyou'=>'d',
//        ];
//
//        $user->notify(new Notifications($notificationData));
    }
}
