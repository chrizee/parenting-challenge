<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Quote;

class QuotesController extends Controller
{
    //base path to views
    private $viewPath = "admin.quotes.";

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::latest()->where('status', '=', '1')->get();
        $data = [
            'title1' => 'Quotes',
            'title2' => 'quotes',
            'quotes' => $quotes
        ];
        return view($this->viewPath.'index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title1' => 'Quotes',
            'title2' => 'quotes',
        ];
        return view($this->viewPath.'create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'quote' => 'required|string',
            'person' => 'nullable|string',
            'image' => 'image|nullable|max:1999'
        ]);
        $quote = new Quote;
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quote_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/quotes', $fileNameToStore);
            $quote->image = $fileNameToStore;
        }
        $quote->quote = $request->input('quote');
        $quote->person = $request->input('person');
        $quote->save();
        return redirect('admin/quotes')->with('success', 'Quote added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::find($id);
        if(!$quote || $quote->status == '0') {
            return redirect('admin/quotes')->with('error', 'Quote does not exist');
        }
        $data = [
            'title1' => 'Quote',
            'title2' => 'quotes',
            'quote' => $quote
        ];
        return view($this->viewPath.'show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'quote' => 'required|string',
            'person' => 'nullable|string',
            'image' => 'nullable|image|max:1999'
        ]);
        $quote = Quote::find($id);
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quote_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/quotes', $fileNameToStore);
            if($quote->image != $this->noImage && !is_null($quote->image)) {
                Storage::delete('public/quotes/'.$quote->image);
            }
            $quote->image = $fileNameToStore;
        }
        $quote->quote = $request->input('quote');
        $quote->person = $request->input('person');
        $quote->save();
        return redirect('admin/quotes/'.$id)->with('success', 'Quote updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        $quote->status = '0';
        $quote->save();
        if($quote->image != $this->noImage && !is_null($quote->image)) {
            Storage::delete('public/quotes/'.$quote->image);
        }
        return redirect('admin/quotes')->with('success', 'Quote deleted successfully');
    }
}
