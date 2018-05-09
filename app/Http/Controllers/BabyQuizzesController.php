<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BabyQuiz;

class BabyQuizzesController extends Controller
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
        $babyQuiz = BabyQuiz::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $data = [
            'title1' => 'Baby Quiz',
            'title2' => 'Quiz',
            'babyQuiz' => $babyQuiz
        ];
        return view('admin.babyQuiz.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title1' => 'Add baby Quiz',
            'title2' => 'Add'
        ];
        return view('admin.babyQuiz.create')->with($data);
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
            'question' => 'required|string',
            'optionA' => 'required|string|max:191',
            'optionB' => 'required|string|max:191',
            'optionC' => 'required|string|max:191',
            'optionD' => 'required|string|max:191',
            'optionE' => 'required|string|max:191',
            'answer' => 'required|string|max:1'
        ]);

        $babyQuiz = new BabyQuiz;
        $babyQuiz->question = $request->input('question');
        $babyQuiz->optionA = $request->input('optionA');
        $babyQuiz->optionB = $request->input('optionB');
        $babyQuiz->optionC = $request->input('optionC');
        $babyQuiz->optionD = $request->input('optionD');
        $babyQuiz->optionE = $request->input('optionE');
        $babyQuiz->answer = $request->input('answer');
        $babyQuiz->save();

        return redirect('admin/babyquiz')->with('success', "Question added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $babyQuiz = BabyQuiz::find($id);
        if(empty($babyQuiz) || $babyQuiz->status == 0) {
            return redirect('/admin/babyquiz')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Parenting Quiz',
            'title2' => 'Quiz',
            'babyQuiz' => $babyQuiz
        ];
        return view('admin.babyQuiz.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $babyQuiz = BabyQuiz::find($id);
        if(empty($babyQuiz) || $babyQuiz->status == 0) {
            return redirect('/admin/babyquiz')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Edit Quiz',
            'title2' => 'Edit',
            'babyQuiz' => $babyQuiz
        ];
        return view('admin.babyQuiz.edit')->with($data);
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
            'optionD' => 'required|string|max:191',
            'optionE' => 'required|string|max:191',
            'answer' => 'required|string|max:1'
        ]);

        $babyQuiz = BabyQuiz::find($id);
        $babyQuiz->question = $request->input('question');
        $babyQuiz->optionA = $request->input('optionA');
        $babyQuiz->optionB = $request->input('optionB');
        $babyQuiz->optionC = $request->input('optionC');
        $babyQuiz->optionD = $request->input('optionD');
        $babyQuiz->optionE = $request->input('optionE');
        $babyQuiz->answer = $request->input('answer');
        $babyQuiz->save();

        return redirect('admin/babyquiz')->with('success', "Question updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $babyQuiz = BabyQuiz::find($id);
        //to deleter permanently
        //$babyQuiz->delete();
        //change the status instead of deleting permanently
        $babyQuiz->status = '0';
        $babyQuiz->save();
        return redirect('admin/babyquiz')->with('success', 'Question deleted');
    }
}
