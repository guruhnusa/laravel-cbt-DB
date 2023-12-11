<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateriRequest;
use App\Models\Material;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materials = Material::paginate(10);
        return view('pages.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('pages.materials.create');
    }


    //edit
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('pages.materials.edit', compact('material'));
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $material = Material::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete('public/' . $material->image);
            $data['image'] = $request->file('image')->store('assets/images/materi', 'public');
        }
        $material->update($data);
        return redirect()->route('materi.index')->with('success', 'Materi Success Updated');
    }

    //store
    public function store(StoreMateriRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/images/materi', 'public');
        Material::create($data);
        return redirect()->route('materi.index')->with('success', 'Materi Success Created');
    }

    //delete
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        Storage::delete('public/' . $material->image);
        $material->delete();
        return redirect()->route('materi.index')->with('success', 'Materi Success Deleted');
    }
}
