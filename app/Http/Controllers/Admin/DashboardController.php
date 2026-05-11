<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Desa;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil laporan dengan kewenangan Kecamatan
        $reports = Report::where('kewenangan', 'Kecamatan')
                        ->with('user')
                        ->latest()
                        ->paginate(10);
        
        // Statistik untuk dashboard
        $totalReports = Report::where('kewenangan', 'Kecamatan')->count();
        $waitingReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'menunggu')->count();
        $processedReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'diproses')->count();
        $completedReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'selesai')->count();
        
        // Ambil semua desa untuk filter (TAMBAHKAN INI)
        $desas = Desa::all();
        
        return view('admin.dashboard', [
            'reports' => $reports,
            'desas' => $desas,  // ← PASTIKAN INI ADA
            'totalReports' => $totalReports,
            'waitingReports' => $waitingReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
        ]);
    }
}