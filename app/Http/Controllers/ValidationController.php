<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    public function validation_english(Request $request){
        return Validator::make($request->all(),[
            'fullName' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
            'document' => 'nullable|mimes:pdf',
        ]);
    }
    public function validation_french(Request $request){
        return Validator::make($request->all(),[
            'fullName' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:20',
            'message' => 'required|string',
            'document' => 'nullable|mimes:pdf',
        ],[
            'fullName.required' => 'Le champs Nom complet est obligatoire',
            'fullName.max' => 'Le champs Prénom ne doit pas dépasser 50 caractères',
            'email.required' => 'Le champs Adresse email est obligatoire',
            'email.max' => 'Le champs Email ne doit pas dépasser 255 caractères',
            'subject.required' => 'Le champs Sujet est obligatoire',
            'subject.max' => 'Le champs Sujet ne doit pas dépasser 200 caractères',
            'message.required' => 'Le champs Message est obligatoire',
            'document.mimes' => 'Le fichier doit être de type pdf',
        ]);
    }
    public function validation_arabic(Request $request){
        return Validator::make($request->all(),[
            'fullName' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:20',
            'message' => 'required|string',
            'document' => 'nullable|mimes:pdf',
        ],[
            'fullName.required' => 'حقل الاسم الكامل إلزامي',
            'fullName.max' => 'يجب ألا يتجاوز حقل الاسم الكامل 50 حرفًا',
            'email.required' => 'حقل البريد الإلكتروني إلزامي',
            'email.max' => 'يجب ألا يتجاوز حقل البريد الإلكتروني 255 حرفًا',
            'subject.required' => 'حقل الموضوع إلزامي',
            'subject.max' => 'يجب ألا يتجاوز حقل الموضوع 200 حرفًا',
            'message.required' => 'حقل الرسالة إلزامي',
            'document.required' => 'الملف يجب أن يكون من نوع pdf',
        ]);
    }
}