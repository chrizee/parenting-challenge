<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
use App\ChildPsychology;

class ChildPsychologiesController extends Controller
{
    //base folder for views in this controller
    private $viewPath = 'admin.childPsychology.';

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
        $childPsychology = ChildPsychology::where('status', '=', '1')->orderBy('created_at', 'DESC')->get();
        $data = [
            'title1' => "Child Psychology",
            'title2' => "Psychology",
            'childPsychology' => $childPsychology
        ];
        return view($this->viewPath."index")->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title1' => 'Add child psychology',
            'title2' => 'Psychology'
        ];
        return view($this->viewPath."create")->with($data);
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
            'quote' => "required|string",
            'image' => 'required|image|max:1999'
        ]);
        //handle file upload
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'child_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/psychology/child', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }
        $childPsychology = new ChildPsychology;
        $childPsychology->quote = $request->input('quote');
        $childPsychology->image = $fileNameToStore;
        $childPsychology->save();
        return redirect('admin/childpsychology')->with('success', "Quote added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $childPsychology = ChildPsychology::find($id);
        if(empty($childPsychology) || $childPsychology->status == 0) {
            return redirect('/admin/childpsychology')->with('error', "Quote does not exist.");
        }
        $data = [
            'title1' => "Child psychology",
            'title2' => "Psychology",
            'childPsychology' => $childPsychology
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
        $childPsychology = ChildPsychology::find($id);
        if(empty($childPsychology) || $childPsychology->status == 0) {
            return redirect('/admin/childpsychology')->with('error', "Quote does not exist.");
        }
        $data = [
            'title1' => "Edit child psychology",
            'title2' => "Psychology",
            'childPsychology' => $childPsychology
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
            'quote' => "required|string",
            'image' => 'nullable|image|max:1999'
        ]);

        $childPsychology = ChildPsychology::find($id);
        //handle file upload
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'child_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/psychology/child', $fileNameToStore);
            if($childPsychology->image != $this->noImage) {
                Storage::delete("public/psychology/child/".$childPsychology->image);
            }
            $childPsychology->image = $fileNameToStore;
        }

        $childPsychology->quote = $request->input('quote');
        $childPsychology->save();
        return redirect('admin/childpsychology/'.$id)->with('success', "Quote updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childPsychology = ChildPsychology::find($id);
        if($childPsychology->image != $this->noImage) {
            Storage::delete('public/psychology/child/'.$childPsychology->image);
        }
        $childPsychology->status = '0';
        $childPsychology->save();

        return redirect('admin/childpsychology')->with('success', 'Quote removed');
    }
}
