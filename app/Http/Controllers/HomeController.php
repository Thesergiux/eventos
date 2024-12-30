<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Specialist;

class HomeController extends Controller
{
    public function index()
    {
        $sports = Activity::where('type','Deportes')->get();
        $workshops = Activity::where('type','Taller')->get();

        return view('principal.home', compact('sports', 'workshops'));
    }

    public function specialists()
    {
        $specialists = Specialist::all();
        return view('principal.especialistas', compact('specialists'));
    }
    public function specialist($slug)
    {
        $specialist = Specialist::find($slug);
        return view('principal.especialista',compact('specialist'));
    }

    public function actividad($slug)
    {
        $activity = Activity::find($slug);
        return view('principal.actividad',compact('activity'));
    }
}
