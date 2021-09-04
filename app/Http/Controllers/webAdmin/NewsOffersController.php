<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\webAdmin\NewsOffer;

class NewsOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsOffers = NewsOffer::get();
        return view('admin.view-news-offers', compact('newsOffers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-news-offers');
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
            'description'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png', 
            'type'=>'required',
            'show_untill_date'=>'required',
        ]);

        $getUploadedName = HelperController::uplaodsingleImage($request->file('image'),'images/news-offers/');

        $newsOffers = new NewsOffer();
        $newsOffers->title = $request->title;
        $newsOffers->description = $request->description;
        $newsOffers->image = $getUploadedName;
        $newsOffers->type = $request->type;
        $newsOffers->show_untill_date = $request->show_untill_date;
        $newsOffers->save();
        return redirect()->route('webadminnews-offers.index')->with('news_offers_added', 'News/Offer added successfully.');
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
        $newsOffers = NewsOffer::find($id);
        return view('admin.edit-news-offers', compact('newsOffers'));
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
            'description'=>'required',
            // 'image'=>'required|mimes:jpg,jpeg,png', 
            'type'=>'required',
            'show_untill_date'=>'required',
        ]);
        
        $newsOffers = NewsOffer::find($id);

        if($request->image)
        {
            $getUploadedName = HelperController::uplaodsingleImage($request->file('image'),'images/news-offers/');
            $newsOffers->image = $getUploadedName;
        }

        $newsOffers->title = $request->title;
        $newsOffers->description = $request->description;
        $newsOffers->type = $request->type;
        $newsOffers->show_untill_date = $request->show_untill_date;
        $newsOffers->save();
        return redirect()->route('webadminnews-offers.index')->with('news-offers_updated', 'News/Offers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsOffers = NewsOffer::find($id);
        $newsOffers->delete();
        return redirect()->route('webadminnews-offers.index')->with('news_offers_deleted', 'News/Offer deleted successfully.'); 
    }


        // Ajax Enable/Disable Status 
        public function changeStatus($id) {

            $news = NewsOffer::find($id);
            $class = '';
            
            if($news->status == 0) {
                $news->status = 1;
                $text = 'Enabled';
                $removeClass = 'bg-danger';
                $class = 'bg-success';
            } else {
                $news->status = 0;
                $text = 'Disabled';
                $removeClass = 'bg-success';
                $class = 'bg-danger';
            }
    
            if($news->save()) {
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