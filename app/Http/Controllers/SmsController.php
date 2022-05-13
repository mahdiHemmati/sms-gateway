<?php

namespace App\Http\Controllers;

use App\Http\Resources\SmsResource;
use App\Models\Sms;
use App\Notifications\SmsNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class SmsController extends Controller
{
    public function index() 
    {
        return SmsResource::collection(Sms::all());
    }

    public function send(Request $request) 
    {
        $sms = Sms::create($request->merge([
            'from' => config()->get('kavenegar.from')
        ])->all());

        try {
            Notification::route('kaveh_sms', $request->to)
            ->notify(new SmsNotification($request->to, $request->message));
        } catch (Exception $e) {
            $sms->update([
                'status' => 'failed',
                'because' => $e->getMessage()
            ]);
        }

        return new SmsResource($sms);
    }
}
