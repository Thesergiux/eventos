<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.events') || Gate::allows('create.events'), 403);
        $events = Event::all();
        return view('admin.eventos.index', compact('events'));   
    }

    public function save(EventRequest $request)
    {
        abort_unless(Gate::allows('view.events') || Gate::allows('edit.events'), 403);
        
        $event = new Event;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date  = $request->start_date;
        $event->finish_date = $request->finish_date;
        $event->status = 'Active';
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/eventos'), $fileName);
            $event->cover = 'img/eventos/' . $fileName;
        }
        $event->save();

        alert('Se ha agregado un evento.');

        return response('', 204, [
            'Redirect-To' => url('admin/eventos/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.events') || Gate::allows('edit.events'), 403);
        $event = Event::find($id);

        return view('admin.eventos.editar', compact('event'));
    }


    public function update(EventRequest $request, $id)
    {
        abort_unless(Gate::allows('view.events') || Gate::allows('edit.events'), 403);

        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date  = $request->start_date;
        $event->finish_date = $request->finish_date;
        $event->status = 'Active';
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/eventos'), $fileName);
            $event->cover = 'img/eventos/' . $fileName;
        }
        $event->save();

        alert('Se ha actualizado un evento.');

        return response('', 204, [
            'Redirect-To' => url('admin/eventos/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.events') || Gate::allows('create.events'), 403);

        $event = Event::find($id);
        $event->delete();
        
        return response('', 204);

    }
}
