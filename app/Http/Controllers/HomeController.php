<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;

use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }

    public function contacts() {
        return view('guest.contacts');
    }

    public function contactsSent(Request $request) {
        // @dd($request->request);

        //per salvare le mail nel database
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        //per inviare la mail
        Mail::to('commerciale@boolpress.com')->send(new SendNewMail($new_lead));

        return redirect()->route('contacts');
    }
}
// CONTROLLER DELLA HOME DEI GUEST