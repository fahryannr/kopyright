<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index(){

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $pes = Pesanan::all();
        return view('/pesanan',['pesan'=> $pes]);
    }

    public function create(){

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $pemesanan = Pesanan::all();
        return view('/pesanan', ['pesanan' => $pemesanan]);
    }

    public function store(Request $request) {
        $pesan = Pesanan::create($request->all());
        return redirect('/pesanan');
    }

    public function konfirmasi($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
    
        // Update status menjadi 'confirmed'
        $pesanan->status = 'confirmed';
        $pesanan->save();
    
        // Simpan data ke tabel laporan
        Laporan::create([
            'daftarpesanan' => $pesanan->daftarPesanan,
            'total' => $pesanan->totalHarga,
            'namapemesan' => $pesanan->namaPemesan,
        ]);
    
        // Set session success
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikonfirmasi dan masuk ke laporan!');
    }
    


    public function delete(Request $request, $id)
    {
        $kathap = Pesanan::findOrFail($id);
        $kathap->delete();
        return redirect('/pesanan');
    }

}
