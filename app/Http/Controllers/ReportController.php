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

    // ================= DASHBOARD =================
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard', [
            'reports' => $reports,
            'totalReports' => $reports->count(),
            'waitingReports' => $reports->where('status', 'menunggu')->count(),
            'processedReports' => $reports->where('status', 'diproses')->count(),
            'completedReports' => $reports->where('status', 'selesai')->count(),
        ]);
    }

    // ================= FORM CREATE =================
    public function create()
    {
        return view('reports.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathFoto = null;

        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('reports', 'public');
        }

        $report = Report::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'foto' => $pathFoto,
            'status' => 'menunggu',
        ]);

        // 🔥 REDIRECT KE SUCCESS PAGE (INI YANG BENAR)
        return redirect()->route('reports.success', $report->id);
    }

    // ================= SUCCESS PAGE =================
    public function success($id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        return view('reports.success', compact('report'));
    }

    // ================= SHOW DETAIL =================
    public function show(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        return view('reports.show', compact('report'));
    }

    // ================= EDIT =================
    public function edit(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        return view('reports.edit', compact('report'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        $report->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('reports.show', $report->id)
            ->with('success', 'Laporan berhasil diupdate!');
    }

    // ================= DELETE =================
    public function destroy(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $report->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}