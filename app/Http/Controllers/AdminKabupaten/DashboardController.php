<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // HANYA laporan dengan kewenangan 'Kabupaten'
        $reports = Report::where('kewenangan', 'Kabupaten')
            ->with(['user', 'desaRelasi'])
            ->latest()
            ->paginate(10);

        $totalReports = Report::where('kewenangan', 'Kabupaten')->count();
        $waitingReports = Report::where('kewenangan', 'Kabupaten')->where('status', 'menunggu')->count();
        $processedReports = Report::where('kewenangan', 'Kabupaten')->where('status', 'diproses')->count();
        $completedReports = Report::where('kewenangan', 'Kabupaten')->where('status', 'selesai')->count();

        // Hitung yang belum dibaca oleh kabupaten
        $unreadCount = Report::where('kewenangan', 'Kabupaten')
            ->where('is_read_kabupaten', false)
            ->count();

        return view('admin-kabupaten.dashboard', [
            'reports' => $reports,
            'totalReports' => $totalReports,
            'waitingReports' => $waitingReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
            'unreadCount' => $unreadCount,
        ]);
    }
}
