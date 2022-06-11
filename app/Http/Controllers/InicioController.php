<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['inicios'] = Inicio::all();

        return view('dashboard.inicios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category' => 'required',
        ]);
        $path = $request->file('image')->store('public/images');
        $inicio = new Inicio;
        $inicio->title = $request->title;
        $inicio->category = $request->category;
        $inicio->image = $path;
        $inicio->save();

        return redirect()->route('inicios.index')
                        ->with('success','Post has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $inicio
     * @return \Illuminate\Http\Response
     */
    public function show(Inicio $inicio)
    {
        return view('index.inicios.show',compact('inicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $inicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Inicio $inicio)
    {
        return view('dashboard.inicios.edit',compact('inicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $inicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ]);

        $inicio = Inicio::find($id);
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $inicio->image = $path;
        }
        $inicio->title = $request->title;
        $inicio->category = $request->category;
        $inicio->save();

        return redirect()->route('inicios.index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $inicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inicio $inicio)
    {
        $inicio->delete();

        return redirect()->route('dashboard.inicios.index')
                        ->with('success','Post has been deleted successfully');
    }
}
