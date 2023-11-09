<?php

namespace App\Http\Controllers;

use App\Mail\SendQuote;
use App\Mail\SendToAdmin;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function viewPdf(Request $request){
        try{
            $quote_last_number = Quote::latest()->first();
            $quote = new Quote();
            if($request->input('first_name') === "undefined" && $request->input('last_name') === "undefined"){
                $quote->quote_client_name = "Visitor";
            }else{
                $quote->quote_client_name = $request->input('first_name').' '.$request->input('last_name');
            }
            $quote->quote_client_email = $request->input('email');
            $quote->quote_service = $request->input('service');
            if($quote_last_number === null){
                $quote->quote_number = 1;
            }else{
                $quote->quote_number = $quote_last_number->quote_number + 1;
            }
            $quote->save();
            $functionalities = json_decode($request->input('services'));
            $languages = json_decode($request->input('languages'));
            if($request->input('service') !== "Website Maintenance" && $request->input('service') !== "WordPress Plugin Creation"){
                $data = [
                    'title' => 'Quote',
                    'date' => date('m/d/Y'),
                    'functionalities' => $functionalities,
                    'languages' => $languages,
                    'quote' => $quote->quote_number,
                    'main_service' => $request->input('service'),
                    'initial_price' => $request->input('initial_price'),
                    'sum' => $request->input('sum'),
                    'other_service' => $request->input('other_service'),
                    'page_number' => $request->input('page_number'),
                    'page_price' => $request->input('page_price'),
                    'client_name' => $request->input('first_name').' '.$request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                ];
                $file_name = ($request->input('first_name') ?? "undefined").'-'.($request->input('last_name') ?? "undefined");
                $pdf = PDF::loadView('pdf.view', $data)->save(public_path('storage/files/'.$file_name.'-Quote.pdf'));
                return $pdf->stream('document.pdf');
            }
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function sendQuote(Request $request){
        $language = $request->input('language');
        $hour = date('H');
        $hour_morning = 04;
        $hour_noon = 12;
        $hour_evening = 17;
        $hour_night = 21;
        $greeting = '';
        if($hour >= $hour_morning && $hour < $hour_noon){
            $greeting = 'Good morning';
        }else if($hour >= $hour_noon && $hour < $hour_evening){
            $greeting = 'Good afternoon';
        }else if($hour >= $hour_evening && $hour < $hour_night){
            $greeting = 'Good evening';
        }else{
            $greeting = 'Good night';
        }
        if($request->input('service') !== "Website Maintenance" && $request->input('service') !== "WordPress Plugin Creation"){
            $mailData = [
                'email' => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'service' => $request->input('service'),
                'greeting' => $greeting,
                'attachment' => 'files/'.$request->input('first_name').'-'.$request->input('last_name').'-Quote.pdf',
                'filename' => 'Quote-'.$request->input('service').'.pdf',
            ];
        }else{
            $mailData = [
                'email' => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'service' => $request->input('service'),
                'greeting' => $greeting,
                'rest_services' => $request->input('rest_services'),
            ];
        }
        Mail::to($request->input('email'))->queue(new SendQuote($mailData));
        Mail::to("aymane.chnaif@gmail.com")->queue(new SendToAdmin($mailData));
        $pdfFilePath = public_path('storage/files/' . $request->input('first_name') . '-' . $request->input('last_name') . '-Quote.pdf');
        File::delete($pdfFilePath);
        if($language === "en"){
            return response()->json([
                "status" => 200,
                "message" => "Email sent successfully",
            ]);
        }else if($language === "fr"){
            return response()->json([
                "status" => 200,
                "message" => "Email envoyé avec succèss",
            ]);
        }else{
            return response()->json([
                "status" => 200,
                "message" => "لقد تم إرسال الإيميل بنجاح",
            ]);
        }
    }
}
