<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function test(Request $request){
        $mailData = [
            'subject' => $request->input('subject'),
            'fullName' => $request->input('fullName'),
            'message' => $request->input('message'),
        ];
        Mail::to($request->input('email'))->queue(new SendMessage($mailData));
        return response()->json([
            'status' => '200',
            'message' => 'sent',
        ]);
    }
}
