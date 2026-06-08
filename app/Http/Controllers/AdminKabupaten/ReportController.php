<?php

namespace App\Http\Controllers\AdminKabupaten;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusReportMail;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::findOrFail($id);

        if ($report->is_read_kabupaten == false) {
            $report->is_read_kabupaten = true;
            $report->save();
        }

        return view('admin-kabupaten.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);

            $oldStatus = $report->status;

            $report->status = $request->status;

            if ($request->kewenangan) {
                $report->kewenangan = $request->kewenangan;
            }

            if ($request->catatan_kabupaten) {
                $report->catatan_kabupaten = $request->catatan_kabupaten;
            }

            if ($request->alasan_tolak_kabupaten) {
                $report->alasan_tolak_kabupaten = $request->alasan_tolak_kabupaten;
            }

            if ($request->hasFile('foto_perbaikan')) {
                if ($report->foto_perbaikan && file_exists(public_path($report->foto_perbaikan))) {
                    unlink(public_path($report->foto_perbaikan));
                }

                $file = $request->file('foto_perbaikan');
                $filename = 'perbaikan_kab_' . time() . '_' . $report->id . '.' . $file->getClientOriginalExtension();

                if (!file_exists(public_path('uploads/reports/perbaikan'))) {
                    mkdir(public_path('uploads/reports/perbaikan'), 0777, true);
                }

                $file->move(public_path('uploads/reports/perbaikan'), $filename);
                $report->foto_perbaikan = 'uploads/reports/perbaikan/' . $filename;
            }

            // RESET NOTIFIKASI
            $report->is_read = false;           // masyarakat
            $report->is_read_kecamatan = true;  // kecamatan sudah baca
            $report->is_read_kabupaten = true;  // kabupaten sudah baca
            $report->is_read_provinsi = false;  // provinsi belum baca
            $report->is_read_desa = true;       // desa sudah baca

            $report->save();

            // KIRIM EMAIL KE MASYARAKAT JIKA STATUS BERUBAH
            if ($oldStatus != $report->status && $report->user && $report->user->email) {
                Mail::to($report->user->email)->send(new StatusReportMail($report, $oldStatus, $report->status));
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
