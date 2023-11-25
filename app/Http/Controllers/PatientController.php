<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    // 患者一覧表示
    public function index()
    {
        $all_patients = $this->patient->all();

        return view('patients.index')
                ->with('all_patients', $all_patients);
    }

    // 患者追加
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|min:1|max:15'
        ]);
        $this->patient->name = $request->patient_name;
        $this->patient->save();

        return redirect()->back();
    }

}
