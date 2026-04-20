<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Desa;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        $desas = Desa::all();
        
        return view('admin.dashboard', [
            'reports' => $reports,
            'desas' => $desas,
            'totalReports' => $reports->count(),
            'waitingReports' => $reports->where('status', 'menunggu')->count(),
            'processedReports' => $reports->where('status', 'diproses')->count(),
            'completedReports' => $reports->where('status', 'selesai')->count(),
        ]);
    }
}