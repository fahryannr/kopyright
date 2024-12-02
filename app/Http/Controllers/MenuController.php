<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('/menu', ['menu' => $menu]);
    }

    public function create()
    {

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $menuk = Kategori::select('id', 'nama')->get();
        $menu = Menu::all();
        return view('/tambahmenu', ['tmenu' => $menu, 'kat' => $menuk]);
    }

    public function store(Request $request)
    {
        // Membuat entri baru di tabel Menu
        $menubaru = Menu::create($request->all());
        if ($request->hasFile('foto')) {
            $filename = $request->nama . '-' . now()->timestamp . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('foto/', $filename);
            $menubaru->foto = $filename;
            $menubaru->save();
}
        session()->flash('success', 'Menu berhasil ditambah');
        return redirect('/tambahmenu');

    }

    public function edit(Request $request, $id)
    {

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $menup = Menu::findOrFail($id);
        $kategori = Kategori::select('id', 'nama')->get(); // Ambil semua kategori
        return view('menup', ['update' => $menup, 'kategori' => $kategori]);
    }

    public function update(Request $request, $id)
{

    if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    $kated = Menu::findOrFail($id);
    $kated->update($request->except(['foto']));
    return redirect('/tambahmenu')->with('success', 'Menu berhasil diperbarui!');
}


    public function delete(Request $request, $id)
    {
        $kathap = Menu::findOrFail($id);
        $kathap->delete();
        session()->flash('success', 'Menu berhasil dihapus');
        return redirect('/tambahmenu');
    }

}
