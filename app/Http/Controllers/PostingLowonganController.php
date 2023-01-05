<?php

namespace App\Http\Controllers;

use App\Models\PostingLowongan;
use Illuminate\Http\Request;

class PostingLowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lowongan.index', [
            'lowongans' => PostingLowongan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lowongan.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'posisi' => 'required',
            'deskripsi' => 'required',
            'gaji' => 'required',
            'lokasi' => 'required',
        ]);
        PostingLowongan::create($validatedData);
        return redirect(route('lowongan.index'))->with('success_added', 'Lowongan Pekerjaan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostingLowongan  $postingLowongan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lowongan = PostingLowongan::find($id);
        return view('lowongan.show', [
            'lowongan' => $lowongan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostingLowongan  $postingLowongan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lowongan = PostingLowongan::find($id);
        return view('lowongan/edit', [
            'lowongan' => $lowongan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostingLowongan  $postingLowongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'posisi' => 'required',
            'deskripsi' => 'required',
            'gaji' => 'required',
            'lokasi' => 'required',
        ]);
        $lowongan = PostingLowongan::find($id);
        $lowongan->update($validatedData);
        return redirect(route('lowongan.index'))->with('success_updated', 'Lowongan Pekerjaan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostingLowongan  $postingLowongan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lowongan = PostingLowongan::find($id);
        $lowongan->delete();
        return redirect(route('lowongan.index'))->with('success_deleted', 'Lowongan Pekerjaan berhasil dihapus!');
    }
}
