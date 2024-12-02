<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $laporan = Laporan::all();
        return view('/laporan', ['lapor' => $laporan]);
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'daftarpesanan' => 'required|string',
        'total' => 'required|numeric',
        'namapemesan' => 'required|string',
    ]);

    // Simpan data ke tabel laporan
    Laporan::create([
        'daftarpesanan' => $request->daftarpesanan,
        'total' => $request->total,
        'namapemesan' => $request->namapemesan,
        'tanggal_laporan' => Carbon::now(), // Simpan tanggal laporan
    ]);

    return redirect()->route('laporan.store')->with('success', 'Pesanan berhasil dikonfirmasi!');
}


    public function exportPdf() {

        if (!Auth::check() || Auth::user()->peran->name !== 'kasir') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $data = Laporan::all();
        $pdf = Pdf::loadView('pdf.export-laporan', ['export' => $data]);
        return $pdf->download('export-laporan-' . Carbon::now()->timestamp . '.pdf');
    }

    public function exportExcel(){
        
    }

}
