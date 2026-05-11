<?php

namespace App\Http\Controllers\AdminProvinsi;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);
        return view('admin-provinsi.reports.show', compact('report'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);
            
            $report->status = $request->status;
            
            if ($request->has('catatan_provinsi')) {
                $report->catatan_provinsi = $request->catatan_provinsi;
            }
            
            if ($request->status == 'ditolak' && $request->has('alasan_tolak_provinsi')) {
                $report->alasan_tolak_provinsi = $request->alasan_tolak_provinsi;
            }
            
            $report->save();
            
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}