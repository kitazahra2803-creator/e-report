<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::findOrFail($id);
        
        if ($report->desa_id !== Auth::user()->desa_id) {
            abort(403, 'Unauthorized - Laporan bukan untuk desa Anda');
        }
        
        return view('admin-desa.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);
            
            if ($report->desa_id !== Auth::user()->desa_id) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            
            $status = $request->input('status');
            $kewenangan = $request->input('kewenangan');
            $catatan = $request->input('catatan');
            $alasanTolak = $request->input('alasan_tolak');
            
            $updateData = [
                'status' => $status,
                'updated_at' => now()
            ];
            
            if ($kewenangan) {
                $updateData['kewenangan'] = $kewenangan;
            }
            
            if ($catatan) {
                $updateData['catatan'] = $catatan;
            }
            
            if ($alasanTolak) {
                $updateData['alasan_tolak'] = $alasanTolak;
            }
            
            // Upload foto perbaikan jika ada (hanya saat status selesai)
            if ($request->hasFile('foto_perbaikan')) {
                $fotoPerbaikan = $request->file('foto_perbaikan')->store('perbaikan', 'public');
                $updateData['foto_perbaikan'] = $fotoPerbaikan;
            }
            
            DB::table('reports')->where('id', $id)->update($updateData);
            
            return response()->json(['success' => true, 'redirect' => route('admin-desa.dashboard')]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}