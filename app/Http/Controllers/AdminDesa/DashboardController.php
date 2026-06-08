<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $namaDesa = $user->desaRelasi ? $user->desaRelasi->nama_desa : 'Desa';

        // HANYA ambil laporan dengan kewenangan 'Desa' dan desa_id milik admin ini
        $reports = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->with('user')
            ->latest()
            ->paginate(10);

        // Hitung laporan yang belum dibaca oleh desa (hanya kewenangan Desa)
        $unreadCount = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->where('is_read_desa', false)
            ->count();

        $totalReports = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->count();
        $waitingReports = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->where('status', 'menunggu')
            ->count();
        $processedReports = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->where('status', 'diproses')
            ->count();
        $completedReports = Report::where('desa_id', $user->desa_id)
            ->where('kewenangan', 'Desa')  // TAMBAHKAN INI
            ->where('status', 'selesai')
            ->count();

        return view('admin-desa.dashboard', [
            'reports' => $reports,
            'namaDesa' => $namaDesa,
            'totalReports' => $totalReports,
            'waitingReports' => $waitingReports,
            'processedReports' => $processedReports,
            'completedReports' => $completedReports,
            'unreadCount' => $unreadCount,
        ]);
    }
}
