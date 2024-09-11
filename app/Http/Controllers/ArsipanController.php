<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Employee_record;
use App\Models\User;
use App\Models\FamilyData;
use App\Models\Arsipan;

class ArsipanController extends Controller
{
    public function index()
{
    $archives = Arsipan::all();  // Ambil semua data dari tabel Archive
    return view('Arsipan.index', compact('Arsipan'));
}

    public function arsipan(Request $request)
    {
        $id = $request->input('id');
        $employee = Employee_record::findOrFail($id);

        $employee->status = 'arsip';
        $employee->save();

        return redirect()->back()->with('success', 'Data karyawan berhasil diarsipkan.');
    }

    public function destroy($id_number)
    {
        $employee = Employee::where('id_number', $id_number)->first();
        if (!$employee) {
            return redirect()->route('karyawan.index')->with('error', 'Employee not found.');
        }
    
        FamilyData::where('id_number', $id_number)->delete();
    
        Employee_record::where('id_number', $id_number)->delete();
    
        User::where('email', $employee->email)->delete();
    
         $employee->delete();
    
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus!');
    }
}

