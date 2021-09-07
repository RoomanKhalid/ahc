<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\webAdmin\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('admin.view-banners', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-banner');
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
            'name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png', 
        ]);

        $getUploadedName = HelperController::uplaodsingleImage($request->file('image'),'images/banners/');

        $banner = new Banner;
        $banner->name = $request->name;
        $banner->image = $getUploadedName;
        $banner->save();
        return redirect()->route('webadminbanner.index')->with('banner_added', 'Banner added successfully.');
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
        $banner = Banner::find($id);
        return view('admin.edit-banner', compact('banner'));
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
            'name'=>'required',
        ]);
        
        $banner = Banner::find($id);

        
        if($request->image)
        {
            $getUploadedName = HelperController::uplaodsingleImage($request->file('image'),'images/banners/');
            $banner->image = $getUploadedName;
        }

        $banner->name = $request->name;
        $banner->save();
        return redirect()->route('webadminbanner.index')->with('banner_updated', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('webadminbanner.index')->with('banner_deleted', 'Banner deleted successfully.'); 
    }

    // Ajax Enable/Disable Status 
    public function changeStatus($id) {

        $banner = Banner::find($id);
        $class = '';
        
        if($banner->status == 0) {
            $banner->status = 1;
            $text = 'Enabled';
            $removeClass = 'bg-danger';
            $class = 'bg-success';
        } else {
            $banner->status = 0;
            $text = 'Disabled';
            $removeClass = 'bg-success';
            $class = 'bg-danger';
        }

        if($banner->save()) {
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