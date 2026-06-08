<?php

namespace App\Http\Controllers\AdminProvinsi;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // HANYA laporan dengan kewenangan 'Provinsi'
        $reports = Report::where('kewenangan', 'Provinsi')
            ->with(['user', 'desaRelasi'])
            ->latest()
            ->paginate(10);

        $totalReports = Report::where('kewenangan', 'Provinsi')->count();
        $waitingReports = Report::where('kewenangan', 'Provinsi')->where('status', 'menunggu')->count();
        $processedReports = Report::where('kewenangan', 'Provinsi')->where('status', 'diproses')->count();
        $completedReports = Report::where('kewenangan', 'Provinsi')->where('status', 'selesai')->count();

        // Hitung yang belum dibaca oleh provinsi
        $unreadCount = Report::where('kewenangan', 'Provinsi')
            ->where('is_read_provinsi', false)
            ->count();

        return view('admin-provinsi.dashboard', [
            'reports' => $reports,
            'totalReports' => $totalReports,
            'waitingReports' => $waitingReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
            'unreadCount' => $unreadCount,
        ]);
    }
}
