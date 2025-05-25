<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // Patikriname formos įvestis
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Paimame patvirtintus duomenis
        $formData = $request->only(['name', 'email', 'message']);

        // Išsiunčiame el. laišką su formos duomenimis
        Mail::to('ainis.pipyne@stud.svako.lt')->send(new FormSubmissionMail($formData));

        // Grąžiname su sėkmės žinute
        return back()->with('success', 'Forma sėkmingai pateikta ir kopija išsiųsta el. paštu.');
    }
}