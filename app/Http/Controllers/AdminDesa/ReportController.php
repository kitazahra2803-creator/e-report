<?php

namespace App\Http\Controllers\AdminDesa;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusReportMail;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::findOrFail($id);

        if ($report->desa_id !== Auth::user()->desa_id) {
            abort(403, 'Unauthorized - Laporan bukan untuk desa Anda');
        }

        if ($report->is_read_desa == false) {
            $report->is_read_desa = true;
            $report->save();
        }

        return view('admin-desa.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        if ($report->desa_id !== Auth::user()->desa_id) {
            return redirect()->back()->with('error', 'Laporan bukan untuk desa Anda');
        }

        $oldStatus = $report->status;

        if ($request->has('action') && $request->action == 'tolak') {
            $report->status = 'ditolak';
            $report->alasan_tolak = $request->alasan_tolak;
        } else {
            $report->status = $request->status;

            if ($request->kewenangan) {
                $report->kewenangan = $request->kewenangan;
            }

            if ($request->filled('catatan')) {
                $report->catatan = $request->catatan;
            }

            if ($request->hasFile('foto_perbaikan')) {
                if ($report->foto_perbaikan && file_exists(public_path($report->foto_perbaikan))) {
                    unlink(public_path($report->foto_perbaikan));
                }

                $file = $request->file('foto_perbaikan');
                $filename = 'perbaikan_' . time() . '_' . $report->id . '.' . $file->getClientOriginalExtension();

                if (!file_exists(public_path('uploads/reports/perbaikan'))) {
                    mkdir(public_path('uploads/reports/perbaikan'), 0777, true);
                }

                $file->move(public_path('uploads/reports/perbaikan'), $filename);
                $report->foto_perbaikan = 'uploads/reports/perbaikan/' . $filename;
            }
        }

        // RESET NOTIFIKASI UNTUK SEMUA LEVEL
        $report->is_read = false;           // masyarakat
        $report->is_read_desa = true;       // desa sudah baca
        $report->is_read_kecamatan = false; // kecamatan belum baca
        $report->is_read_kabupaten = false; // kabupaten belum baca
        $report->is_read_provinsi = false;  // provinsi belum baca

        $report->save();

        // KIRIM EMAIL KE MASYARAKAT JIKA STATUS BERUBAH
        if ($oldStatus != $report->status && $report->user && $report->user->email) {
            Mail::to($report->user->email)->send(new StatusReportMail($report, $oldStatus, $report->status));
        }

        return redirect()->route('admin-desa.dashboard')->with('success', 'Status laporan berhasil diupdate!');
    }
}
