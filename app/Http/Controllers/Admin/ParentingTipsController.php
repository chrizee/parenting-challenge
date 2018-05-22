<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ParentingTips;

class ParentingTipsController extends Controller
{
    private $viewPath = 'admin.parentingTips.';
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
            'title1' => 'Add parenting Tips',
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
            $fileNameToStore = 'tip_parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/tips/parent', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }
        $parentingTips = new ParentingTips;
        $parentingTips->tip = $request->input('tip');
        $parentingTips->image = $fileNameToStore;
        $parentingTips->save();

        return redirect()->route('parentingtips.index')->with('success', "Tip added");
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
        if(empty($parentingTips) || $parentingTips->status == 0) {
            return redirect()->route('parentingtips.index')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Parenting Tips',
            'title2' => 'Tips',
            'parentingTips' => $parentingTips
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
        $parentingTip = ParentingTips::find($id);
        if(empty($parentingTip) || $parentingTip->status == 0) {
            return redirect()->route('parentingtips.index')->with('error', "Tip does not exist.");
        }
        $data = [
            'title1' => 'Edit parenting tip',
            'title2' => 'Edit',
            'parentingTip' => $parentingTip
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
        $parentingTips = ParentingTips::find($id);

        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'tip_parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/tips/parent', $fileNameToStore);
            if($parentingTips->image != $this->noImage) {
                Storage::delete("public/tips/parent/".$parentingTips->image);
            }
            $parentingTips->image = $fileNameToStore;
        }
        $parentingTips->tip = $request->input('tip');
        $parentingTips->save();

        return redirect()->route('parentingtips.show', $id)->with('success', "Tip updated");
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
        //to delete permanently
        //$parentingTips->delete();
        //change the status instead of deleting permanently
        if(!empty($parentingTips->image) && $parentingTips->image != $this->noImage) {
            Storage::delete('public/tips/parent/'.$parentingTips->image);
        }
        $parentingTips->status = '0';
        $parentingTips->save();
        return redirect()->route('parentingtips.index')->with('success', 'Tip deleted');
    }
}
