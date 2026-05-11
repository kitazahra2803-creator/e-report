<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);
        return view('admin-kabupaten.reports.show', compact('report'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        try {
            // ✅ VALIDASI
            $request->validate([
                'status' => 'required|in:menunggu,diproses,selesai,ditolak',
                'kewenangan' => 'nullable|string', // ← TAMBAHKAN VALIDASI KEWENANGAN
                'catatan_kabupaten' => 'nullable|string',
                'alasan_tolak_kabupaten' => 'nullable|string',
            ]);

            $report = Report::findOrFail($id);

            // update status DAN kewenangan
            if ($request->has('status')) {
                $report->status = $request->status;
            }
            
            if ($request->has('kewenangan')) {
                $report->kewenangan = $request->kewenangan;
            }

            // update catatan
            if ($request->has('catatan_kabupaten')) {
                $report->catatan_kabupaten = $request->catatan_kabupaten;
            }

            // jika ditolak → wajib alasan
            if ($request->status === 'ditolak') {
                $report->alasan_tolak_kabupaten = $request->alasan_tolak_kabupaten;
            } else {
                $report->alasan_tolak_kabupaten = null;
            }

            $report->save();

            // ✅ KEMBALIKAN JSON (bukan redirect)
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}