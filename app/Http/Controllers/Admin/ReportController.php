<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);
            
            $status = $request->input('status');
            $catatan = $request->input('catatan');
            $alasanTolak = $request->input('alasan_tolak');
            
            $updateData = [
                'status' => $status,
                'updated_at' => now()
            ];
            
            // Catatan dari admin kecamatan disimpan ke kolom catatan_kecamatan
            if ($catatan) {
                $updateData['catatan_kecamatan'] = $catatan;
            }
            
            // Alasan tolak disimpan ke kolom alasan_tolak_kecamatan
            if ($alasanTolak) {
                $updateData['alasan_tolak_kecamatan'] = $alasanTolak;
            }
            
            // Upload foto perbaikan jika ada (hanya saat status selesai)
            if ($request->hasFile('foto_perbaikan')) {
                $fotoPerbaikan = $request->file('foto_perbaikan')->store('perbaikan', 'public');
                $updateData['foto_perbaikan'] = $fotoPerbaikan;
            }
            
            DB::table('reports')->where('id', $id)->update($updateData);
            
            return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.reports.show', compact('report'));
    }
}