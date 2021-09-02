<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\webAdmin\Popup;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popups = Popup::orderBy('id', 'DESC')->get();
        return view('admin.view-popups', compact('popups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-popup');
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
            'title'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png', 
        ]);

        if($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/popups', $fileNameToStore);
        }

        $popup = new Popup;
        $popup->title = $request->title;
        $popup->image = $fileNameToStore;
        $popup->save();
        return redirect()->route('webadminpopup.index')->with('popup_added', 'Popup added successfully.');
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
        $popup = Popup::find($id);
        return view('admin.edit-popup', compact('popup'));
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
            'title'=>'required', 
        ]);
        
        $popup = Popup::find($id);

        if($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/popups', $fileNameToStore);
        }
        else{
            $fileNameToStore = $popup->image;
        }
        $popup->title = $request->title;
        $popup->image = $fileNameToStore;
        $popup->save();
        return redirect()->route('webadminpopup.index')->with('popup_updated', 'Popup updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $popup = Popup::find($id);
        $popup->delete();
        return redirect()->route('webadminpopup.index')->with('popup_deleted', 'Popup deleted successfully.');
    }
    // Ajax Enable/Disable Status 
    public function changeStatus($id) {

        $popup = Popup::find($id);
        $class = '';
        
        if($popup->status == 0) {
            $popup->status = 1;
            $text = 'Enabled';
            $removeClass = 'bg-danger';
            $class = 'bg-success';
        } else {
            $popup->status = 0;
            $text = 'Disabled';
            $removeClass = 'bg-success';
            $class = 'bg-danger';
        }

        if($popup->save()) {
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