<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialist;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SpecialistRequest;
use Illuminate\Support\Str;
use Auth;

class SpecialistController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.specialists') || Gate::allows('create.specialists'), 403);
        $specialists = Specialist::all();
        return view('admin.especialistas.index', compact('specialists'));   
    }

    public function save(SpecialistRequest $request)
    {
        abort_unless(Gate::allows('view.specialists') || Gate::allows('edit.specialists'), 403);
        
        $specialist = new Specialist;
        $specialist->name = $request->name;
        $specialist->speciality = $request->speciality;
        $specialist->phone = $request->phone;
        $specialist->email = $request->email;
        $specialist->description = $request->description;        
        $specialist->user_id = Auth::user()->id;
        
        
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->move(public_path('img/especialistas'), $fileName);
        $specialist->photo = 'img/especialistas/' . $fileName;
    }
    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->move(public_path('img/especialistas'), $fileName);
        $specialist->cover = 'img/especialistas/' . $fileName;
    }

        $specialist->save();

        alert('Se ha agregado un(a) especialista.');

        return response('', 204, [
            'Redirect-To' => url('admin/especialistas/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.specialists') || Gate::allows('edit.specialists'), 403);
        $specialist = Specialist::find($id);
        return view('admin.especialistas.editar', compact('specialist'));
    }


    public function update(SpecialistRequest $request, $id)
    {
        abort_unless(Gate::allows('view.specialists') || Gate::allows('edit.specialists'), 403);
        
        $specialist = Specialist::find($id);
        $specialist->name = $request->name;
        $specialist->speciality = $request->speciality;
        $specialist->phone = $request->phone;
        $specialist->email = $request->email;
        $specialist->description = $request->description;        
        $specialist->user_id = Auth::user()->id;    
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/especialistas'), $fileName);
            $specialist->photo = 'img/especialistas/' . $fileName;
        }
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/especialistas'), $fileName);
            $specialist->cover = 'img/especialistas/' . $fileName;
        }
        
        $specialist->save();

        alert('Se ha actualizado un(a) especialista.');

        return response('', 204, [
            'Redirect-To' => url('admin/especialistas/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.specialists') || Gate::allows('create.specialists'), 403);

        $post = Specialist::find($id);
        $post->delete();

        return response('', 204);

    }
}
