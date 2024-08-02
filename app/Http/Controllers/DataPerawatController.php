<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPerawatController extends Controller
{
    public function index()
    {
        $dataPerawat = User::all();
        $title = 'data';
        return view('admin.dataPerawat', compact('dataPerawat', 'title'));
    }

    public function store(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|min:10',
            'password' => 'required|min:8|same:cpassword',
            'certification' => 'required'
        ], [
            'name.required' => 'name wajib diisi',
            'name.min' => 'name minimal 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.min' => 'Email minimal 10 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.same' => 'Password and confirm password do not match',
            'certification.required' => 'Certification wajib diisi',
        ]);

        if ($val->fails()) {
            return redirect()->route('dataPerawat.index')->with('error', $val->errors()->first());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'certification' => $request->certification
        ]);
        return redirect()->route('dataPerawat.index')->with('success', 'Perawat created successfully.');
    }

    public function update(Request $request, $id)
    {
        $val = Validator::make($request->only(['name', 'email', 'certification']), [
            'name' => 'required|min:5',
            'email' => 'required|min:10',
            'certification' => 'required'
        ], [
            'name.required' => 'name wajib diisi',
            'name.min' => 'name minimal 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.min' => 'Email minimal 10 karakter',
            'certification.required' => 'Certification wajib diisi',
        ]);

        if ($val->fails()) {
            return redirect()->route('dataPerawat.index')->with('error', $val->errors()->first());
        }

        $dataPerawat = User::findOrFail($id);
        $dataPerawat->update($request->only(['name', 'email', 'certification']));
        return redirect()->route('dataPerawat.index')->with('success', 'Perawat updated successfully.');
    }

    public function destroy($id)
    {
        $dataPerawat = User::findOrfail($id);
        $dataPerawat->delete();
        return redirect()->route('dataPerawat.index')->with('success', 'Perawat deleted successfully.');
    }
}
