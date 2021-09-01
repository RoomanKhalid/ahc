<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use App\Models\webAdmin\FooterSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerTexts = FooterSection::get();
        // return $footerTexts;
        return view('admin.view-footer-text', compact('footerTexts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.add-footer-text');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'prefix_line' => 'required',
            'postfix_words' => 'required',
            ]);

            $errors = $validator->errors();

            if($validator->fails()) 
            {
              return redirect()->back()->withErrors($errors);
            }
            else
            {
                $footerText = new FooterSection();
                $footerText->prefix_line = $request->prefix_line;
                $footerText->postfix_words = $request->postfix_words;
                $footerText->save();
                return redirect()->route('webadminfooter-section.index')->with('text_added', 'Footer text added successfully.'); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\webAdmin\FooterSection  $footerSection
     * @return \Illuminate\Http\Response
     */
    public function show(FooterSection $footerSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\webAdmin\FooterSection  $footerSection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $text = FooterSection::find($id);
        return view('admin.edit-footer-text', compact('text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\webAdmin\FooterSection  $footerSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $footerText = FooterSection::find($id);
        $footerText->prefix_line = $request->prefix_line;
        $footerText->postfix_words = $request->postfix_words;
        $footerText->save();
        return redirect()->route('webadminfooter-section.index')->with('text_updated', 'Footer text updated successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\webAdmin\FooterSection  $footerSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $footerText = FooterSection::find($id);
        $footerText->delete();
        return redirect()->route('webadminfooter-section.index')->with('text_deleted', 'Footer text deleted successfully.');  
    }
}