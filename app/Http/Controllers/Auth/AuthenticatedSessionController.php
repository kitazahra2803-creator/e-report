<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } 
    elseif ($user->role === 'admin_desa') {
        return redirect()->route('admin-desa.dashboard');
    } 
    elseif ($user->role === 'admin_kecamatan') {
        return redirect()->route('admin.dashboard'); // atau route khusus kecamatan
    }
    elseif ($user->role === 'admin_kabupaten') {
        return redirect()->route('admin-kabupaten.dashboard');
    }

    elseif ($user->role === 'admin_provinsi') {
        return redirect()->route('admin-provinsi.dashboard');
    }

    return redirect()->route('dashboard');
}

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}