<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::all();
          return view('kamar.index', ["kamar" => $kamar]);
    }

    public function store(Request $request)
    {
            Kamar::create($request->all());
            return redirect('kamar')->with('success', 'Task Created Successfully!');
    }

    public function edit($id)
    {
        $kamar = Kamar::all();
        $dataskamar = Kamar::find($id);
        return view("kamar.index",  ["kamar" => $kamar, "dataskamar" => $dataskamar]);
    }

    public function update(Request $request, $id)
    {
        $dataskamar = Kamar::find($id)->update($request->all());
        return redirect('kamar')->with('success', 'Task Created Successfully!');
    }

    public function delete($id) 
    {
        $dataskamar = Kamar::find($id)->delete();
        return redirect('kamar')->with('success', 'Task Created Successfully!');

    }
}
