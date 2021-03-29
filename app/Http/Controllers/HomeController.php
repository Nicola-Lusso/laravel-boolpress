<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function contatti()
    {
        return view('guest.contatti');
    }


    public function contattiSent(Request $request)
    {
        $data = $request->all();
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();
        Mail::to( 'info@boolpress.com' )->send(new SendNewMail($newLead));

        
        return redirect()->route('guest.contatti')->with('status', 'messaggio inviato');
    }
}
