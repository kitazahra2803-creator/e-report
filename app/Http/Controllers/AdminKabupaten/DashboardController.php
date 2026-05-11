<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil laporan dengan kewenangan Kabupaten
        $reports = Report::where('kewenangan', 'Kabupaten')
                        ->with('user')
                        ->latest()
                        ->paginate(10);
        
        // Statistik untuk dashboard
        $totalLaporan = Report::where('kewenangan', 'Kabupaten')->count();
        $menunggu = Report::where('kewenangan', 'Kabupaten')->where('status', 'menunggu')->count();
        $diproses = Report::where('kewenangan', 'Kabupaten')->where('status', 'diproses')->count();
        $selesai = Report::where('kewenangan', 'Kabupaten')->where('status', 'selesai')->count();
        
        return view('admin-kabupaten.dashboard', [
            'reports' => $reports,
            'totalLaporan' => $totalLaporan,
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai' => $selesai,
        ]);
    }
}