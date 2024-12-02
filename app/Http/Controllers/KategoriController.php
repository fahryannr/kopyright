<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{


    public function index(){
        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $kat = Kategori::all();
        return view('/pengelolaan',['kategori'=> $kat]);
    }

    public function create(){

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kate = Kategori::all();
        return view('/tambahkat', ['tamkat' => $kate]);
    }

    public function store(Request $request) {
        $katbaru = Kategori::create($request->all());
        session()->flash('success', 'Kategori berhasil ditambah');
        return redirect('/tambahkat');
    }

    public function edit(Request $request, $id)
    {

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $katup = Kategori::findOrFail($id);
        return view('/katup', ['update' => $katup]);
    }

    public function update(Request $request, $id)
    {
        $kated = Kategori::findOrFail($id);
        $kated->update($request->all());
        session()->flash('success', 'Kategori berhasil perbarui');
        return redirect('/tambahkat');
    }


    public function delete(Request $request, $id){
        $kathap = Kategori::findOrFail($id);
        $kathap->delete();
        session()->flash('success', 'Kategori berhasil dihapus');
        return redirect('/tambahkat');
    }

}
