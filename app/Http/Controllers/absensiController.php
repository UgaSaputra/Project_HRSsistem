<?php

namespace App\Http\Controllers;
use App\Models\absensi;
use Illuminate\Http\Request;
use App\Models\Employee;

class absensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('Employee')->get();
        return view('absensi.index', compact('absensi'));
    }
    public function store(Request $request) {
        $date = date('Y-m-d');
        $time = date('H:i:s');
    
        $absensi = new Absensi();
        $absensi->id_number = $request->id_number;
        $absensi->keterangan = 'hadir';
        $absensi->created_at = $date;
        $absensi->updated_at = $time;
        $absensi->save();
    
        return redirect()->back()->with('success', 'Data terekam!');
    }
    
}
