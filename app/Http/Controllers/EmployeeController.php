<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsipan;
use App\Models\Employee;
use App\Models\FamilyData;
use Illuminate\Http\Request;
use App\Models\Employee_record;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeController extends Controller
{
    public function export()
    {
        $employees = Employee::with('familyData')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'A1' => 'Nomor ID',
            'B1' => 'Nama Lengkap',
            'C1' => 'Nama Panggilan',
            'D1' => 'Tanggal Kontrak',
            'E1' => 'Tanggal Masuk Kerja',
            'F1' => 'Status',
            'G1' => 'Jabatan',
            'H1' => 'NUPTK',
            'I1' => 'Jenis Kelamin',
            'J1' => 'Tempat Lahir',
            'K1' => 'Tanggal Lahir',
            'L1' => 'Agama',
            'M1' => 'Email',
            'N1' => 'Hobi',
            'O1' => 'Status Perkawinan',
            'P1' => 'Alamat Tinggal',
            'Q1' => 'Telepon',
            'R1' => 'Alamat Darurat',
            'S1' => 'Telepon Darurat',
            'T1' => 'Golongan Darah',
            'U1' => 'Pendidikan Terakhir',
            'V1' => 'Lembaga',
            'W1' => 'Tahun Lulus',
            'X1' => 'Tempat Pelatihan Kompetensi',
            'Y1' => 'Pengalaman Organisasi',
            'Z1' => 'Nama Pasangan',
            'AA1' => 'Nama Anak',
            'AB1' => 'Tanggal Pernikahan',
            'AC1' => 'Nomor Sertifikat Pernikahan',
            'AD1' => 'created_at',
            'AE1' => 'updated_at'
        ];

        foreach ($headers as $cell => $header) {
            $sheet->setCellValue($cell, $header);
        }

        $row = 2;
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee->id_number);
            $sheet->setCellValue('B' . $row, $employee->full_name);
            $sheet->setCellValue('C' . $row, $employee->nickname);
            $sheet->setCellValue('D' . $row, $employee->contract_date);
            $sheet->setCellValue('E' . $row, $employee->work_date);
            $sheet->setCellValue('F' . $row, $employee->status);
            $sheet->setCellValue('G' . $row, $employee->position);
            $sheet->setCellValue('H' . $row, $employee->nuptk);
            $sheet->setCellValue('I' . $row, $employee->gender);
            $sheet->setCellValue('J' . $row, $employee->place_birth);
            $sheet->setCellValue('K' . $row, $employee->birth_date);
            $sheet->setCellValue('L' . $row, $employee->religion);
            $sheet->setCellValue('M' . $row, $employee->email);
            $sheet->setCellValue('N' . $row, $employee->hobby);
            $sheet->setCellValue('O' . $row, $employee->marital_status);
            $sheet->setCellValue('P' . $row, $employee->residence_address);
            $sheet->setCellValue('Q' . $row, $employee->phone);
            $sheet->setCellValue('R' . $row, $employee->address_emergency);
            $sheet->setCellValue('S' . $row, $employee->phone_emergency);
            $sheet->setCellValue('T' . $row, $employee->blood_type);
            $sheet->setCellValue('U' . $row, $employee->last_education);
            $sheet->setCellValue('V' . $row, $employee->agency);
            $sheet->setCellValue('W' . $row, $employee->graduation_year);
            $sheet->setCellValue('X' . $row, $employee->competency_training_place);
            $sheet->setCellValue('Y' . $row, $employee->organizational_experience);

            if ($employee->familyData) {
                $familyData = $employee->familyData->first();

                $sheet->setCellValue('Z' . $row, $familyData->mate_name ?? '');
                $sheet->setCellValue('AA' . $row, $familyData->child_name ?? '');
                $sheet->setCellValue('AB' . $row, $familyData->wedding_date ?? '');
                $sheet->setCellValue('AC' . $row, $familyData->wedding_certificate_number ?? '');
            } else {
                $sheet->setCellValue('Z' . $row, '');
                $sheet->setCellValue('AA' . $row, '');
                $sheet->setCellValue('AB' . $row, '');
                $sheet->setCellValue('AC' . $row, '');
            }

            $sheet->setCellValue('AD' . $row, $employee->created_at);
            $sheet->setCellValue('AE' . $row, $employee->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'employee_data.xlsx';

        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function inputPage()
    {
        return view('HRS.input');
    }
    public function index()
    {
        $employees = Employee_record::with('familyData')->get();
        $employees = Employee::all();
        return view('HRS.tampildata', compact('employees'));
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->id_number = $request->id_number;
        $employee->full_name = $request->full_name;
        $employee->nickname = $request->nickname;
        $employee->contract_date = $request->contract_date;
        $employee->date_fixed = $request->date_fixed;
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
        $employee->date_fixed = $request->date_fixed;
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
    // public function destroy($id_number)
    // {
    //     $employee = Employee::where('id_number', $id_number)->first();
    //     if (!$employee) {
    //         return redirect()->route('karyawan.index')->with('error', 'Employee not found.');
    //     }

    //     FamilyData::where('id_number', $id_number)->delete();

    //     Employee_record::where('id_number', $id_number)->delete();

    //     User::where('email', $employee->email)->delete();

    //      $employee->delete();

    //     return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus!');
    // }

    public function archive($id_number)
    {
        // Ambil data employee dan family terkait
        $employee = Employee_record::with('familyData')->where('id_number', $id_number)->first();

        // Pindahkan data ke tabel arsip
        Arsipan::create([
            'id_number' => $employee->id_number,
            'full_name' => $employee->full_name,
            'nickname' => $employee->nickname,
            'contract_date' => $employee->contract_date,
            'work_date' => $employee->work_date,
            'status' => $employee->status,
            'position' => $employee->position,
            'nuptk' => $employee->nuptk,
            'gender' => $employee->gender,
            'place_birth' => $employee->place_birth,
            'birth_date' => $employee->birth_date,
            'religion' => $employee->religion,
            'email' => $employee->email,
            'hobby' => $employee->hobby,
            'marital_status' => $employee->marital_status,
            'residence_address' => $employee->residence_address,
            'phone' => $employee->phone,
            'address_emergency' => $employee->address_emergency,
            'phone_emergency' => $employee->phone_emergency,
            'blood_type' => $employee->blood_type,
            'last_education' => $employee->last_education,
            'agency' => $employee->agency,
            'graduation_year' => $employee->graduation_year,
            'competency_training_place' => $employee->competency_training_place,
            'organizational_experience' => $employee->organizational_experience,
            'mate_name' => $employee->familyData->mate_name ?? null,
            'child_name' => $employee->familyData->child_name ?? null,
            'wedding_date' => $employee->familyData->wedding_date ?? null,
            'wedding_certificate_number' => $employee->familyData->wedding_certificate_number ?? null,
        ]);

        // Hapus data dari tabel asli
        $employee->familyData->delete();
        $employee->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diarsipkan');
    }
}
