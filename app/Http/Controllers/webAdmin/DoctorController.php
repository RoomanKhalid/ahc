<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\webAdmin\Doctor;
use App\Models\Clinic;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id', 'DESC')->get();
        return view('admin.view-doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::get();
        return view('admin.add-doctor', compact('clinics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'clinic_id' => 'required',
            'doctor_name' => 'required',
            'short_description' => 'required',
            'appointment_duration' => 'required',
            'doctor_profile_image' => 'required|mimes:jpg,jpeg,png',
            'mobile_no' => 'required',
            'designation' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
            'type' => 'required',
            'center' => 'required',
        ]);

        if($request->hasFile('doctor_profile_image')) {
            $fileNameWithExt = $request->file('doctor_profile_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('doctor_profile_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('doctor_profile_image')->storeAs('public/images/doctors', $fileNameToStore);
        }

        $doctor = new Doctor;
        $doctor->clinic_id = $request->clinic_id;
        $doctor->doctor_name = $request->doctor_name;
        $doctor->short_description = $request->short_description;
        $doctor->description = $request->description;
        $doctor->appointment_duration = $request->appointment_duration;
        $doctor->doctor_profile_image = $fileNameToStore;
        $doctor->mobile_no = $request->mobile_no;
        $doctor->designation = $request->designation;
        $doctor->joining_date = $request->joining_date;
        $doctor->status = $request->status;
        $doctor->type = $request->type;
        $doctor->center = $request->center;
        $doctor->expense = $request->expense;
        $doctor->bank_charges = $request->bank_charges;
        $doctor->ayaan_percent = $request->ayaan_percent;
        $doctor->doctor_percent = $request->doctor_percent;
        $doctor->save();
        return redirect()->route('webadmindoctor.index')->with('doctor_added', 'Doctor added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $clinics = Clinic::get();
        return view('admin.edit-doctor', compact('doctor', 'clinics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'clinic_id' => 'required',
            'doctor_name' => 'required',
            'short_description' => 'required',
            'appointment_duration' => 'required',
            'mobile_no' => 'required',
            'designation' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
            'type' => 'required',
            'center' => 'required',
        ]);
        
        $doctor = Doctor::find($id);

        if($request->hasFile('doctor_profile_image')) {
            $fileNameWithExt = $request->file('doctor_profile_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('doctor_profile_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('doctor_profile_image')->storeAs('public/images/doctors', $fileNameToStore);
        }
        else{
            $fileNameToStore = $doctor->doctor_profile_image;
        }
        $doctor->clinic_id = $request->clinic_id;
        $doctor->doctor_name = $request->doctor_name;
        $doctor->short_description = $request->short_description;
        $doctor->description = $request->description;
        $doctor->appointment_duration = $request->appointment_duration;
        $doctor->doctor_profile_image = $fileNameToStore;
        $doctor->mobile_no = $request->mobile_no;
        $doctor->designation = $request->designation;
        $doctor->joining_date = $request->joining_date;
        $doctor->status = $request->status;
        $doctor->type = $request->type;
        $doctor->center = $request->center;
        $doctor->expense = $request->expense;
        $doctor->bank_charges = $request->bank_charges;
        $doctor->ayaan_percent = $request->ayaan_percent;
        $doctor->doctor_percent = $request->doctor_percent;
        $doctor->save();
        return redirect()->route('webadmindoctor.index')->with('doctor_updated', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('webadmindoctor.index')->with('doctor_deleted', 'Doctor deleted successfully.');
    }
    // Ajax Enable/Disable Status 
    public function changeStatus($id) {

        $doctor = Doctor::find($id);
        $class = '';
        
        if($doctor->status == 0) {
            $doctor->status = 1;
            $text = 'Enabled';
            $removeClass = 'bg-danger';
            $class = 'bg-success';
        } else {
            $doctor->status = 0;
            $text = 'Disabled';
            $removeClass = 'bg-success';
            $class = 'bg-danger';
        }

        if($doctor->save()) {
            $st = 1;
            $msg = 'Status Updated Successfully';
        } else {
            $st = 0;
            $msg = 'Unable to disable Text';
        }
        return response()->json([
            'status' => $st,
            'text' => $text,
            'msg' => $msg,
            'class' => $class,
            'removeClass' => $removeClass
        ]);
    }
}
