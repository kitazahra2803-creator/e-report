<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // HANYA laporan dengan kewenangan 'Kecamatan'
        $reports = Report::where('kewenangan', 'Kecamatan')
            ->with(['user', 'desaRelasi'])
            ->latest()
            ->paginate(10);

        $totalReports = Report::where('kewenangan', 'Kecamatan')->count();
        $waitingReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'menunggu')->count();
        $processedReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'diproses')->count();
        $completedReports = Report::where('kewenangan', 'Kecamatan')->where('status', 'selesai')->count();

        // Hitung yang belum dibaca oleh kecamatan
        $unreadCount = Report::where('kewenangan', 'Kecamatan')
            ->where('is_read_kecamatan', false)
            ->count();

        return view('admin.dashboard', [
            'reports' => $reports,
            'totalReports' => $totalReports,
            'waitingReports' => $waitingReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
            'unreadCount' => $unreadCount,
        ]);
    }
}
