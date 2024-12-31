<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\User;
use App\Models\Participant;
use App\Http\Requests\RegisterRequest;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::get();
        return view('principal.home', compact('events'));
    }

    public function event($id)
    {
        $event = Event::find($id);
        return view('principal.event',compact('event'));
    }
    public function register(RegisterRequest $request, $id)
    {
        $team = new Team;
        $team->name = $request->team;
        $team->save();

        $project = new Project;
        $project->name = $request->project;
        $project->description = $request->description;
        $project->event_id = $id;
        $project->team_id  = $team->id;
        $project->save();
        
        for($i = 1; $i <= $request->participant_count; $i++){
            $user = new User;
            $user->name = $request['participant'.$i.'_name'];
            $user->last_name = $request['participant'.$i.'_lastname'];
            $user->email = $request['participant'.$i.'_email'];
            $user->role_id = 4;
            $user->save();

            $participant = new Participant;
            $participant->user_id = $user->id;
            $participant->team_id = $team->id;
            $participant->save();


        }
        alert('Se ha registrado un equipo.');

        return response('', 204, [
            'Redirect-To' => url('evento/'.$id)
        ]);    }
}
