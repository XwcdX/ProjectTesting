<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', [
            'admin' => $admin,
            'title' => 'Dashboard'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    public function view(){
        return view('admin.dataPerawat',[
            'title' => 'Data'
        ]);
    }

    public function index()
    {
        $perawat = User::all();
        return response()->json($perawat,200,[
            'Content-Type' => 'application/json',
            'allowed_methods' => 'GET, POST, PUT, DELETE',
            'allowed_origins' => '*',
            'access-control-allow-origin' => '*',
        ]);
    }
    public function store(Request $request)
    {
        $val = Validator::make($request->only(['name', 'email', 'password', 'certification']), [
            'name' => 'required|min:5',
            'email' => 'required|min:10',
            'password' => 'required|min:8',
            'certification' => 'required|min:10'
        ], [
            'name.required' => 'name wajib diisi',
            'name.min' => 'name minimal 5 karakter',
            'email.required' => 'Nama wajib diisi',
            'email.min' => 'Nama minimal 10 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 10 karakter',
            'certification.required' => 'Alamat wajib diisi',
            'certification.min' => 'Alamat minimal 10 karakter'
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 420);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'certification' => $request->certification
        ]);
        return response()->json([
            'message' => 'Data mahasiswa berhasil ditambahkan'
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $perawat = User::find($id);
        $perawat->update($request->all());
        return response()->json($perawat, 200);
    }

    public function destroy($id)
    {
        $perawat = User::find($id);
        $perawat->delete();
        return response()->json([
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 200);
    }
}
