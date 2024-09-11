<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Employee_record;

class PelanggaranController extends Controller
{
    public function inputPelanggaran()
    {
        return view('Pelanggaran.Input');
    }
    public function index()
    {
        $employees = Employee::with('employeeRecord')->get();
        $employees = Employee_record::all();  
        $tampilkan = Employee_record::all();
        return view('Pelanggaran.index', compact('employees', 'tampilkan'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('pelanggaran.input', compact('employees'));
    }

    public function store(Request $request)
    {
        $employeeRecord = new Employee_record();
        $employeeRecord->id_number = $request->input('id_number');
        $employeeRecord->offense_type = $request->input('offense_type');
        $employeeRecord->offense_date = $request->input('offense_date');
        $employeeRecord->description = $request->input('description');
        $employeeRecord->save();

        return redirect()->route('Pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $employeeRecord = Employee_record::find($id);
        if ($employeeRecord) {
            return view('Pelanggaran.edit', compact('employeeRecord'));
        }

        return redirect()->route('Pelanggaran.index')->with('error', 'Data tidak ditemukan');
    }

    public function update(Request $request, $id)
    {
        $employeeRecord = Employee_record::find($id);
        if ($employeeRecord) {
            $employeeRecord->id_number = $request->input('id_number');
            $employeeRecord->offense_type = $request->input('offense_type');
            $employeeRecord->offense_date = $request->input('offense_date');
            $employeeRecord->description = $request->input('description');
            $employeeRecord->save();

            return redirect()->route('Pelanggaran.index')->with('success', 'Pelanggaran berhasil diperbarui');
        }

        return redirect()->route('Pelanggaran.index')->with('error', 'Data tidak ditemukan');
    }

    public function destroy($id)
    {
        $employeeRecord = Employee_record::find($id);

        if ($employeeRecord) {
            $employeeRecord->delete();
            return redirect()->route('Pelanggaran.index')->with('success', 'Pelanggaran berhasil dihapus');
        }

        return redirect()->route('Pelanggaran.index')->with('error', 'Data tidak ditemukan');
    }
}
