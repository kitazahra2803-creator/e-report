<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reports = Report::where('user_id', Auth::id())
            ->with('desaRelasi')
            ->latest()
            ->get();

        $unreadCount = $reports->where('is_read', false)->count();

        return view('dashboard', [
            'reports' => $reports,
            'totalReports' => $reports->count(),
            'waitingReports' => $reports->where('status', 'menunggu')->count(),
            'processedReports' => $reports->where('status', 'diproses')->count(),
            'completedReports' => $reports->where('status', 'selesai')->count(),
            'unreadCount' => $unreadCount,
        ]);
    }

    public function create()
    {
        $desas = \App\Models\Desa::all();
        return view('reports.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $report = new Report();
        $report->user_id = Auth::id();
        $report->judul = $request->judul;
        $report->lokasi = $request->lokasi;
        $report->deskripsi = $request->deskripsi;
        $report->desa_id = $request->desa_id;
        $report->kecamatan = $request->kecamatan;
        $report->kabupaten = $request->kabupaten;
        $report->provinsi = $request->provinsi;
        $report->status = 'menunggu';
        $report->kewenangan = 'Desa';
        $report->is_read = false;
        $report->is_read_desa = false;
        $report->is_read_kecamatan = false;
        $report->is_read_kabupaten = false;
        $report->is_read_provinsi = false;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reports'), $filename);
            $report->foto = 'uploads/reports/' . $filename;
        }

        $report->save();

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        if ($report->is_read == false) {
            $report->is_read = true;
            $report->save();
        }

        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $desas = \App\Models\Desa::all();
        return view('reports.edit', compact('report', 'desas'));
    }

    public function update(Request $request, Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $report->judul = $request->judul;
        $report->lokasi = $request->lokasi;
        $report->deskripsi = $request->deskripsi;
        $report->desa_id = $request->desa_id;
        $report->kecamatan = $request->kecamatan;
        $report->kabupaten = $request->kabupaten;
        $report->provinsi = $request->provinsi;

        if ($request->hasFile('foto')) {
            if ($report->foto && file_exists(public_path($report->foto))) {
                unlink(public_path($report->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reports'), $filename);
            $report->foto = 'uploads/reports/' . $filename;
        }

        $report->save();

        return redirect()->route('reports.show', $report->id)->with('success', 'Laporan berhasil diupdate!');
    }

    public function destroy(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        if ($report->foto && file_exists(public_path($report->foto))) {
            unlink(public_path($report->foto));
        }

        $report->delete();
        return redirect()->route('dashboard')->with('success', 'Laporan dihapus!');
    }
}
