<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail(SendMailRequest $request) {
        $dataForm = $request->all();

        Mail::send('email', ['dataForm' => $dataForm], function ($message) use ($dataForm) {
            $message->to(env('MAIL_TO'))
                    ->subject('send mail from home page');
        });



        return redirect()->back()->with('success', "Send mail successfully!");
    }
}
