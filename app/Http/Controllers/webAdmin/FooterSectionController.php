<?php

namespace App\Http\Controllers\webAdmin;

use App\Http\Controllers\Controller;
use App\Models\webAdmin\FooterSection;
use Illuminate\Http\Request;

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
    public function create()
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
        $footerText = new FooterSection();
        $footerText->prefix_line = $request->prefix_line;
        $footerText->postfix_words = $request->postfix_words;
        $footerText->status = 1;
        $footerText->save();
        session()->flash('text_added', 'Footer text added successfully.');
        return redirect('webadmin/footer-section');
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
        return $id;
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
        session()->flash('text_added', 'Footer text added successfully.');
        return redirect('webadmin/footer-section');
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
