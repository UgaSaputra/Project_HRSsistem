<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsipan;
use App\Models\Employee;
use App\Models\FamilyData;
use Illuminate\Http\Request;
use App\Models\Employee_record;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class EmployeeController extends Controller
{
    public function import(Request $request)
{
    // Validasi file yang diupload
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Ambil file yang diupload
    $file = $request->file('file');
    $spreadsheet = IOFactory::load($file->path());
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Skip header
    array_shift($data);

    // Nilai yang valid untuk kolom ENUM
    $allowedStatuses = ['Aktif', 'Berhenti'];
    $allowedGenders = ['pria', 'wanita'];
    $allowedMaritalStatuses = ['menikah', 'belum',];

    // Loop setiap baris di file Excel
    foreach ($data as $row) {
        if (count($row) >= 24) { 
            // Ambil data dari Excel
            $id_number = $row[0];
            $full_name = $row[1];
            $nickname = $row[2];
            $contract_date = $this->convertDate($row[3]);
            $status = $row[6];
            $gender = $row[7];
            $marital_status = $row[12];

            // Validasi kolom ENUM
            if (!in_array($status, $allowedStatuses)) {
                return back()->with('error', 'Status tidak valid.');
            }
            if (!in_array($gender, $allowedGenders)) {
                return back()->with('error', 'Gender tidak valid.');
            }
            if (!in_array($marital_status, $allowedMaritalStatuses)) {
                return back()->with('error', 'Status pernikahan tidak valid.');
            }

            // Simpan data ke database
            Employee::updateOrCreate(
                ['id_number' => $id_number], // Key untuk update atau create
                [
                    'full_name' => $full_name,
                    'nickname' => $nickname,
                    'contract_date' => $contract_date,
                    'status' => $status,
                    'gender' => $gender,
                    'marital_status' => $marital_status,
                    'work_date' => $this->convertDate($row[4]),
                    'position' => $row[5],
                    'place_birth' => $row[8],
                    'birth_date' => $this->convertDate($row[9]),
                    'religion' => $row[10],
                    'email' => $row[11],
                    'residence_address' => $row[13],
                    'phone' => $row[14],
                    'address_emergency' => $row[15],
                    'phone_emergency' => $row[16],
                    'blood_type' => $row[17],
                    'last_education' => $row[18],
                    'agency' => $row[19],
                    'graduation_year' => $row[20],
                    'competency_training_place' => $row[21],
                    'organizational_experience' => $row[22],
                ]
            );
        }
    }

    return back()->with('success', 'Data berhasil diimpor!');
}

private function convertDate($date)
{
    if ($date instanceof \PhpOffice\PhpSpreadsheet\Cell\Cell) {
        return Date::excelToDateTimeObject($date->getValue())->format('Y-m-d');
    }

    return date('Y-m-d', strtotime($date));
}
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
            'name' => $employee->name,
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
    public function Arsip()
    {
        $Arsipan = Arsipan::all();

        return view('Arsipan.index', compact('Arsipan'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function archive($id_number)
    {
        $employee = Employee::with('familyData')->where('id_number', $id_number)->firstOrFail();

        DB::table('arsipans')->insertOrIgnore([
            'id_number' => $employee->id_number,
            'full_name' => $employee->full_name,
            'nickname' => $employee->nickname,
            'contract_date' => $employee->contract_date,
            'date_fixed' => $employee->date_fixed,
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
            'mate_name' => $employee->familyData->mate_name ?? '',
            'child_name' => $employee->familyData->child_name ?? '',
            'wedding_date' => $employee->familyData->wedding_date ?? '',
            'wedding_certificate_number' => $employee->familyData->wedding_certificate_number ?? '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($employee->familyData) {
            $employee->familyData->delete();
        }

        $employee->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diarsipkan.');
    }
    public function destroy($id_number)
    {
        $arsip = Arsipan::where('id_number', $id_number)->first();

        if ($arsip) {
            $arsip->delete();
            return back()->with('success', 'Data berhasil dihapus!');
        }

        return back()->with('error', 'Data tidak ditemukan!');
    }
}
