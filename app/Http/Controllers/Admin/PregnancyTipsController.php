<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\PregnancyTips;

class PregnancyTipsController extends Controller
{
    private $viewPath = 'admin.pregnancyTips.';
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
            'title1' => 'Add pregnancy Tips',
            'title2' => 'Add'
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
            'tip' => 'required|string',
            'image' => 'required|max:1999|mimes:jpeg,jpg,png,webp,gif'
        ]);
        
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'tip_pregnancy_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/tips/pregnancy', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }
        $pregnancyTips = new PregnancyTips;
        $pregnancyTips->tip = $request->input('tip');
        $pregnancyTips->image = $fileNameToStore;
        $pregnancyTips->save();

        return redirect()->route('pregnancytips.index')->with('success', "Tip added");
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
        if(empty($pregnancyTips) || $pregnancyTips->status == 0) {
            return redirect()->route('pregnancytips.index')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Pregnancy Tips',
            'title2' => 'Tips',
            'pregnancyTips' => $pregnancyTips
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
        $pregnancyTip = PregnancyTips::find($id);
        if(empty($pregnancyTip) || $pregnancyTip->status == 0) {
            return redirect()->route('pregnancytips.index')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Edit pregnancy tip',
            'title2' => 'Edit',
            'pregnancyTip' => $pregnancyTip
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
            'tip' => 'required|string',
            'image' => 'nullable|max:1999|mimes:jpeg,jpg,png,webp,gif'
        ]);

        $pregnancyTips = PregnancyTips::find($id);

        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'tip_pregnancy_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/tips/pregnancy', $fileNameToStore);
            if($pregnancyTips->image != $this->noImage) {
                Storage::delete("public/tips/pregnancy/".$pregnancyTips->image);
            }
            $pregnancyTips->image = $fileNameToStore;
        }
        $pregnancyTips->tip = $request->input('tip');
        $pregnancyTips->save();

        return redirect()->route('pregnancytips.show', $id)->with('success', "Tip updated");
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
        if(!empty($pregnancyTips->image) && $pregnancyTips->image != $this->noImage) {
            Storage::delete('public/tips/pregnancy/'.$pregnancyTips->image);
        }
        $pregnancyTips->status = '0';
        $pregnancyTips->save();
        return redirect()->route('pregnancytips.index')->with('success', 'Tip deleted');
    }
}
