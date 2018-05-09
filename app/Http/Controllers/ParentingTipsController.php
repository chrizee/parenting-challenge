<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParentingTips;

class ParentingTipsController extends Controller
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
        $parentingTips = ParentingTips::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $data = [
            'title1' => 'Parenting Tips',
            'title2' => 'Tips',
            'parentingTips' => $parentingTips
        ];
        return view('admin.parentingTips.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title1' => 'Add parenting Tips',
            'title2' => 'Add'
        ];
        return view('admin.parentingTips.create')->with($data);
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

        $parentingTips = new ParentingTips;
        $parentingTips->tip = $request->input('tip');
        $parentingTips->save();

        return redirect('admin/parentingtips')->with('success', "Tip added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentingTips = ParentingTips::find($id);
        if($parentingTips->status == 0) {
            return redirect('/admin/parentingtips')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Parenting Tips',
            'title2' => 'Tips',
            'parentingTips' => $parentingTips
        ];
        return view('admin.parentingTips.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentingTip = ParentingTips::find($id);
        if($parentingTip->status == 0) {
            return redirect('/admin/parentingtips')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Edit parenting tip',
            'title2' => 'Edit',
            'parentingTip' => $parentingTip
        ];
        return view('admin.parentingTips.edit')->with($data);
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

        $parentingTips = ParentingTips::find($id);
        $parentingTips->tip = $request->input('tip');
        $parentingTips->save();

        return redirect('admin/parentingtips')->with('success', "Tip updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parentingTips = ParentingTips::find($id);
        //to deleter permanently
        //$parentingTips->delete();
        //change the status instead of deleting permanently
        $parentingTips->status = '0';
        $parentingTips->save();
        return redirect('admin/parentingtips')->with('success', 'Tip deleted');
    }
}
