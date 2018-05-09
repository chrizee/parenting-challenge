<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PregnancyTips;

class PregnancyTipsController extends Controller
{
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
        $pregnancyTips = PregnancyTips::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $data = [
            'title1' => 'Pregnancy Tips',
            'title2' => 'Tips',
            'pregnancyTips' => $pregnancyTips
        ];
        return view('admin.pregnancyTips.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title1' => 'Add pregnancy Tips',
            'title2' => 'Add'
        ];
        return view('admin.pregnancyTips.create')->with($data);
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
            'tip' => 'required|string'
        ]);

        $pregnancyTips = new PregnancyTips;
        $pregnancyTips->tip = $request->input('tip');
        $pregnancyTips->save();

        return redirect('admin/pregnancytips')->with('success', "Tip added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregnancyTips = PregnancyTips::find($id);
        if($pregnancyTips->status == 0) {
            return redirect('/admin/pregnancytips')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Pregnancy Tips',
            'title2' => 'Tips',
            'pregnancyTips' => $pregnancyTips
        ];
        return view('admin.pregnancyTips.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pregnancyTip = PregnancyTips::find($id);
        if($pregnancyTip->status == 0) {
            return redirect('/admin/pregnancytips')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Edit pregnancy tip',
            'title2' => 'Edit',
            'pregnancyTip' => $pregnancyTip
        ];
        return view('admin.pregnancyTips.edit')->with($data);
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
            'tip' => 'required|string'
        ]);

        $pregnancyTips = PregnancyTips::find($id);
        $pregnancyTips->tip = $request->input('tip');
        $pregnancyTips->save();

        return redirect('admin/pregnancytips')->with('success', "Tip updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregnancyTips = PregnancyTips::find($id);
        //to deleter permanently
        //$pregnancyTips->delete();
        //change the status instead of deleting permanently
        $pregnancyTips->status = '0';
        $pregnancyTips->save();
        return redirect('admin/pregnancytips')->with('success', 'Tip deleted');
    }
}
