<?php

namespace App\Http\Controllers\AdminProvinsi;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil laporan dengan kewenangan Provinsi
        $reports = Report::where('kewenangan', 'Provinsi')
                        ->with('user')
                        ->latest()
                        ->paginate(10);
        
        // Statistik untuk dashboard
        $totalLaporan = Report::where('kewenangan', 'Provinsi')->count();
        $menunggu = Report::where('kewenangan', 'Provinsi')->where('status_provinsi', 'menunggu')->count();
        $diproses = Report::where('kewenangan', 'Provinsi')->where('status_provinsi', 'diproses')->count();
        $selesai = Report::where('kewenangan', 'Provinsi')->where('status_provinsi', 'selesai')->count();
        
        return view('admin-provinsi.dashboard', [
            'reports' => $reports,
            'totalLaporan' => $totalLaporan,
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai' => $selesai,
        ]);
    }
}