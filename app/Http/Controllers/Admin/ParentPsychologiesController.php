<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
use App\ParentPsychology;

class ParentPsychologiesController extends Controller
{
    //base folder for views in this controller
    private $viewPath = 'admin.parentPsychology.';

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
        $parentPsychology = ParentPsychology::where('status', '=', '1')->orderBy('created_at', 'DESC')->get();
        $data = [
            'title1' => "Parenting Psychology",
            'title2' => "Psychology",
            'parentPsychology' => $parentPsychology
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
            'title1' => 'Add parenting psychology',
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
            $fileNameToStore = 'parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/psychology/parent', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }
        $parentPsychology = new ParentPsychology;
        $parentPsychology->quote = $request->input('quote');
        $parentPsychology->image = $fileNameToStore;
        $parentPsychology->save();
        return redirect('admin/parentpsychology')->with('success', "Quote added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentPsychology = ParentPsychology::find($id);
        if(empty($parentPsychology) || $parentPsychology->status == 0) {
            return redirect('/admin/parentpsychology')->with('error', "Quote does not exist.");
        }
        $data = [
            'title1' => "Parenting psychology",
            'title2' => "Psychology",
            'parentPsychology' => $parentPsychology
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
        $parentPsychology = ParentPsychology::find($id);
        if(empty($parentPsychology) || $parentPsychology->status == 0) {
            return redirect('/admin/parentpsychology')->with('error', "Quote does not exist.");
        }
        $data = [
            'title1' => "Edit parenting psychology",
            'title2' => "Psychology",
            'parentPsychology' => $parentPsychology
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
        $parentPsychology = ParentPsychology::find($id);
        //handle file upload
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/psychology/parent', $fileNameToStore);
            if($parentPsychology->image != $this->noImage) {
                Storage::delete("public/psychology/parent/".$parentPsychology->image);
            }
            $parentPsychology->image = $fileNameToStore;
        }
        $parentPsychology->quote = $request->input('quote');
        $parentPsychology->save();
        return redirect('admin/parentpsychology/'.$id)->with('success', "Quote updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parentPsychology = ParentPsychology::find($id);
        if($parentPsychology->image != $this->noImage) {
            Storage::delete('public/psychology/parent/'.$parentPsychology->image);
        }
        $parentPsychology->status = '0';
        $parentPsychology->save();

        return redirect('admin/parentpsychology')->with('success', 'Quote removed');
    }
}
