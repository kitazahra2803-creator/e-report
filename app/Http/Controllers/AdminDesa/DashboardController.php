<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $desaId = Auth::user()->desa_id;
        $namaDesa = Auth::user()->desa->nama_desa ?? 'Desa';
        
        $reports = Report::where('desa_id', $desaId)->latest()->get();
        
        return view('admin-desa.dashboard', [
            'reports' => $reports,
            'totalReports' => $reports->count(),
            'waitingReports' => $reports->where('status', 'menunggu')->count(),
            'processedReports' => $reports->where('status', 'diproses')->count(),
            'completedReports' => $reports->where('status', 'selesai')->count(),
            'namaDesa' => $namaDesa,
        ]);
    }
}