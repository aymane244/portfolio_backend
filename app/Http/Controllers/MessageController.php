<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
        $language = $request->input('language');
        $validator_english = app(ValidationController::class)->validation_english($request);
        $validator_french = app(ValidationController::class)->validation_french($request);
        $validator_arabic = app(ValidationController::class)->validation_arabic($request);
        if(!$validator_english->fails() || !$validator_french->fails() || !$validator_arabic->fails()){
            if($request->hasFile('document')){
                $file = $request->file('document');
                $filename = $file->getClientOriginalName();
                $request->file('document')->storeAs('files', $filename, 'public');
                $mailData = [
                    'email' => $request->input('email'),
                    'subject' => $request->input('subject'),
                    'fullName' => $request->input('fullName'),
                    'message' => $request->input('message'),
                    'attachment' => 'files/'.$filename,
                    'filename' => $filename,
                ];
            }else{
                $mailData = [
                    'email' => $request->input('email'),
                    'subject' => $request->input('subject'),
                    'fullName' => $request->input('fullName'),
                    'message' => $request->input('message'),
                ];
            }
            Mail::to("aymane.chnaif@gmail.com")->queue(new SendMessage($mailData));
            $pdfFilePath = public_path('storage/files/'.$filename);
            File::delete($pdfFilePath);
        }
        if($language === "en"){
            if($validator_english->fails()){
                return response()->json([
                    'status'=> 400,
                    'message_errors'=> $validator_english->messages()
                ]);
            }else{
                return response()->json([
                    "status" => 200,
                    "message" => "Message sent successfully",
                ]);
            }
        }else if($language === "fr"){
            if($validator_french->fails()){
                return response()->json([
                    'status'=> 400,
                    'message_errors'=> $validator_french->messages()
                ]);
            }else{
                return response()->json([
                    "status" => 200,
                    "message" => "Message envoyé avec succèss",
                ]);
            }
        }else{
            if($validator_arabic->fails()){
                return response()->json([
                    'status'=> 400,
                    'message_errors'=> $validator_arabic->messages()
                ]);
            }else{
                return response()->json([
                    "status" => 200,
                    "message" => "لقد تم إرسال الرسالة بنجاح",
                ]);
            }
        }
    }
}