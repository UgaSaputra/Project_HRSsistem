<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FamilyData;
use App\Models\Employee_record;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee_record::with('familyData')->get();
        $employee = Employee::all();
        return view('HRS.tampildata', compact('employee'));
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->id_number = $request->id_number;
        $employee->full_name = $request->full_name;
        $employee->nickname = $request->nickname;
        $employee->contract_date = $request->contract_date;
        $employee->work_date = $request->work_date;
        $employee->status = $request->status;
        $employee->position = $request->position;
        $employee->nuptk = $request->nuptk;
        $employee->gender = $request->gender;
        $employee->place_birth = $request->place_birth;
        $employee->birth_date = $request->birth_date;
        $employee->religion = $request->religion;
        $employee->email = $request->email;
        $employee->hobby = $request->hobby;
        $employee->marital_status = $request->marital_status;
        $employee->residence_address = $request->residence_address;
        $employee->phone = $request->phone;
        $employee->address_emergency = $request->address_emergency;
        $employee->phone_emergency = $request->phone_emergency;
        $employee->blood_type = $request->blood_type;
        $employee->last_education = $request->last_education;
        $employee->agency = $request->agency;
        $employee->graduation_year = $request->graduation_year;
        $employee->competency_training_place = $request->competency_training_place;
        $employee->organizational_experience = $request->organizational_experience;
        $employee->save();

        $familyData = new FamilyData();
        $familyData->id_number = $request->id_number;
        $familyData->mate_name = $request->mate_name;
        $familyData->child_name = $request->child_name;
        $familyData->wedding_date = $request->wedding_date;
        $familyData->wedding_certificate_number = $request->wedding_certificate_number;
        $familyData->save();

        User::create([
            'email' => $employee->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id_number)
    {
        $employee = Employee::where('id_number', $id_number)->first();
        if (!$employee) {
            return redirect()->route('employee.edit')->with('error', 'Employee not found.');
        }
        $familyData = FamilyData::where('id_number', $id_number)->first();
        return view('HRS.editdata', compact('employee', 'familyData'));
    }

    public function update(Request $request, $id_number)
    {
        $employee = Employee::where('id_number', $id_number)->first();
        if (!$employee) {
            return redirect()->route('employee.edit')->with('error', 'Employee not found.');
        }

        $employee->full_name = $request->full_name;
        $employee->nickname = $request->nickname;
        $employee->contract_date = $request->contract_date;
        $employee->work_date = $request->work_date;
        $employee->status = $request->status;
        $employee->position = $request->position;
        $employee->nuptk = $request->nuptk;
        $employee->gender = $request->gender;
        $employee->place_birth = $request->place_birth;
        $employee->birth_date = $request->birth_date;
        $employee->religion = $request->religion;
        $employee->email = $request->email;
        $employee->hobby = $request->hobby;
        $employee->marital_status = $request->marital_status;
        $employee->residence_address = $request->residence_address;
        $employee->phone = $request->phone;
        $employee->address_emergency = $request->address_emergency;
        $employee->phone_emergency = $request->phone_emergency;
        $employee->blood_type = $request->blood_type;
        $employee->last_education = $request->last_education;
        $employee->agency = $request->agency;
        $employee->graduation_year = $request->graduation_year;
        $employee->competency_training_place = $request->competency_training_place;
        $employee->organizational_experience = $request->organizational_experience;
        $employee->update();

        $familyData = FamilyData::where('id_number', $id_number)->first();
        if ($familyData) {
            $familyData->mate_name = $request->mate_name;
            $familyData->child_name = $request->child_name;
            $familyData->wedding_date = $request->wedding_date;
            $familyData->wedding_certificate_number = $request->wedding_certificate_number;
            $familyData->update();
        }

        $user = User::where('email', $employee->email)->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->update();
        }

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diperbarui!');
    }
    public function destroy($id_number)
    {
        $employee = Employee::where('id_number', $id_number)->first();
        if (!$employee) {
            return redirect()->route('employee.destroy')->with('error', 'Employee not found.');
        }

        $familyData = FamilyData::where('id_number', $id_number)->first();
        if ($familyData) {
            $familyData->delete();
        }

        $user = User::where('email', $employee->email)->first();
        if ($user) {
            $user->delete();
        }


        $employee->delete();

        return redirect()->route('employee.destroy')->with('success', 'Data berhasil dihapus!');
    }
}
