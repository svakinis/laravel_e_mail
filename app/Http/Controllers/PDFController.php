<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;

class PDFController extends Controller
{
    // PDF generavimas ir atsisiuntimas
    public function generatePDF()
    {
        $data = [
            'title' => 'PDF Dokumento Pavadinimas',
            'date' => date('Y-m-d'),
            'content' => 'Tai yra sugeneruotas PDF dokumentas Laravel 10+ versijoje.'
        ];

        $pdf = Pdf::loadView('pdf.document', $data);
        return $pdf->download('dokumentas.pdf');
    }

    // PDF generavimas ir siuntimas el. paštu
    public function sendPDFEmail()
    {
        $email = 'test@example.com';

        Mail::to($email)->send(new PDFMail());

        return "El. laiškas su PDF dokumentu išsiųstas į {$email}";
    }
}