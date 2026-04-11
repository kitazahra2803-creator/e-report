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

    // INI UNTUK DASHBOARD (MENAMPILKAN SEMUA LAPORAN USER)
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();
        
        $totalReports = $reports->count();
        $waitingReports = $reports->where('status', 'menunggu')->count();
        $processedReports = $reports->where('status', 'diproses')->count();
        $completedReports = $reports->where('status', 'selesai')->count();

        return view('dashboard', compact('reports', 'totalReports', 'waitingReports', 'processedReports', 'completedReports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $pathGambar = null;

        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('reports', 'public');
        }

        Report::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'gambar' => $pathGambar,
            'status' => 'menunggu', // default status
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reports.edit', compact('report'));
    }

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

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil diupdate!');
    }

    public function destroy(Report $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $report->delete();

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dihapus!');
    }
}