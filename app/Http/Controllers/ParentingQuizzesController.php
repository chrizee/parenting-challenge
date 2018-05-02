<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParentingQuiz;

class ParentingQuizzesController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = [
            'title1' => 'Parenting Quiz',
            'title2' => 'Quiz'
        ];
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
        return view('admin.parentingQuiz.index')->with($data);
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
        return view('admin.parentingQuiz.create')->with($data);
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
            'question' => 'required',
            'optionA' => 'required',
            'optionB' => 'required',
            'optionC' => 'required',
            'optionD' => 'required',
            'optionE' => 'required',
            'answer' => 'required'
        ]);

        $parentingQuiz = new ParentingQuiz;
        $parentingQuiz->question = $request->input('question');
        $parentingQuiz->optionA = $request->input('optionA');
        $parentingQuiz->optionB = $request->input('optionB');
        $parentingQuiz->optionC = $request->input('optionC');
        $parentingQuiz->optionD = $request->input('optionD');
        $parentingQuiz->optionE = $request->input('optionE');
        $parentingQuiz->answer = $request->input('answer');
        $parentingQuiz->save();

        return redirect('admin/parentingquiz')->with('success', "Question added");
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
        return view('admin.parentingQuiz.show')->with($data);
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
        return view('admin.parentingQuiz.edit')->with($data);
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
            'question' => 'required',
            'optionA' => 'required',
            'optionB' => 'required',
            'optionC' => 'required',
            'optionD' => 'required',
            'optionE' => 'required',
            'answer' => 'required'
        ]);

        $parentingQuiz = ParentingQuiz::find($id);
        $parentingQuiz->question = $request->input('question');
        $parentingQuiz->optionA = $request->input('optionA');
        $parentingQuiz->optionB = $request->input('optionB');
        $parentingQuiz->optionC = $request->input('optionC');
        $parentingQuiz->optionD = $request->input('optionD');
        $parentingQuiz->optionE = $request->input('optionE');
        $parentingQuiz->answer = $request->input('answer');
        $parentingQuiz->save();

        return redirect('admin/parentingquiz')->with('success', "Question updated");
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
        $parentingQuiz->save();
        return redirect('admin/parentingquiz')->with('success', 'Question deleted');
    }
}
