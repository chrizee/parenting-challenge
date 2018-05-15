<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ParentingQuiz;

class ParentingQuizzesController extends Controller
{
    private $viewPath = "admin.parentingQuiz.";

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentingQuiz = ParentingQuiz::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $data = [
            'title1' => 'Parenting Quiz',
            'title2' => 'Quiz',
            'parentingQuiz' => $parentingQuiz
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
            'title1' => 'Add parenting Quiz',
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
        //dd($request->all());
        $this->validate($request, [
            'question' => 'required|string',
            'optionA' => 'required|string|max:191',
            'optionB' => 'required|string|max:191',
            'optionC' => 'required|string|max:191',
            'tip' => 'required|string',
            'description' => 'required|string',
            'answer' => 'required|string|max:1',
            'image' => 'required|image|max:1999'
        ]);

        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quiz_parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/quiz/parent', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }

        $parentingQuiz = new ParentingQuiz;
        $parentingQuiz->question = $request->input('question');
        $parentingQuiz->optionA = $request->input('optionA');
        $parentingQuiz->optionB = $request->input('optionB');
        $parentingQuiz->optionC = $request->input('optionC');
        $parentingQuiz->tip = $request->input('tip');
        $parentingQuiz->description = $request->input('description');
        $parentingQuiz->answer = $request->input('answer');
        $parentingQuiz->image = $fileNameToStore;
        $parentingQuiz->save();

        return redirect()->route('parentingquiz.index')->with('success', 'Question added'); //using named route to redirect
        //return redirect('admin/parentingquiz')->with('success', "Question added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentingQuiz = ParentingQuiz::find($id);
        if($parentingQuiz->status == 0) {
            return redirect('/admin/parentingquiz')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Parenting Quiz',
            'title2' => 'Quiz',
            'parentingQuiz' => $parentingQuiz
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
        $parentingQuiz = ParentingQuiz::find($id);
        if($parentingQuiz->status == 0) {
            return redirect('/admin/parentingquiz')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Edit Quiz',
            'title2' => 'Edit',
            'parentingQuiz' => $parentingQuiz
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
            'question' => 'required|string',
            'optionA' => 'required|string|max:191',
            'optionB' => 'required|string|max:191',
            'optionC' => 'required|string|max:191',
            'tip' => 'required|string',
            'description' => 'required|string',
            'answer' => 'required|string|max:1',
            'image' => 'image|nullable|max:1999'
        ]);

        $parentingQuiz = ParentingQuiz::find($id);
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quiz_parent_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/quiz/parent', $fileNameToStore);
            if($parentingQuiz->image != $this->noImage) {
                Storage::delete("public/quiz/parent/".$parentingQuiz->image);
            }
            $parentingQuiz->image = $fileNameToStore;
        }

        $parentingQuiz->question = $request->input('question');
        $parentingQuiz->optionA = $request->input('optionA');
        $parentingQuiz->optionB = $request->input('optionB');
        $parentingQuiz->optionC = $request->input('optionC');
        $parentingQuiz->tip = $request->input('tip');
        $parentingQuiz->description = $request->input('description');
        $parentingQuiz->answer = $request->input('answer');
        $parentingQuiz->save();

        return redirect()->route('parentingquiz.show', $id)->with('success', "Question updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parentingQuiz = ParentingQuiz::find($id);
        //to deleter permanently
        //$parentingQuiz->delete();
        //change the status instead of deleting permanently
        $parentingQuiz->status = '0';
        if($parentingQuiz->image != $this->noImage) {
            Storage::delete('public/quiz/parent/'.$parentingQuiz->image);
        }
        $parentingQuiz->save();
        return redirect('admin/parentingquiz')->with('success', 'Question deleted');
    }
}
