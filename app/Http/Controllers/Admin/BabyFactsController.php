<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BabyFacts;
use Illuminate\Http\Request;

class BabyFactsController extends Controller
{
    private  $viewPath = 'admin.babyFacts.';
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
        $babyFact = BabyFacts::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $data = [
            'title1' => "Baby Facts",
            'title2' => "Baby Fact",
            'babyFact' => $babyFact,
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
            'title1' => "Baby Facts",
            'title2' => "Baby Fact"
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
        $this->validate($request,[
            'fact' => 'required|string|'
        ]);

        $babyFact = new BabyFacts;
        $babyFact->fact = $request->input('fact');
        $babyFact->save();

        return redirect('/admin/babyfact')->with('success', "Fact added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $babyFact = BabyFacts::find($id);
        if($babyFact->status == 0) {
            return redirect('/admin/babyfact')->with('error', "Fact does not exist.");
        }
        $data = [
            'title1' => 'Baby Fact',
            'title2' => 'Fact',
            'babyFact' => $babyFact
        ];
        //return view($this->viewPath.'index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $babyFact = BabyFacts::find($id);
        if($babyFact->status == 0) {
            return redirect('/admin/babyFact')->with('error', "Fact does not exist.");
        }
        $data = [
            'title1' => 'Edit Fact',
            'title2' => 'Edit',
            'babyFact' => $babyFact
        ];
        return view($this->viewPath.'edit')->with($data);
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
            'fact' => 'required|string'
        ]);

        $babyFact = BabyFacts::find($id);
        $babyFact->fact = $request->input('fact');
        $babyFact->save();
        return redirect('admin/babyfact/')->with('success', 'Fact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $babyFact = BabyFacts::find($id);
        //to deleter permanently
        //$babyFact->delete();
        //change the status instead of deleting permanently
        $babyFact->status = '0';
        $babyFact->save();
        return redirect('admin/babyfact')->with('success', 'Fact deleted');
    }
}
