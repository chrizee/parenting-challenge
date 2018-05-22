<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BabyQuiz;

class BabyQuizzesController extends Controller
{

    private $viewPath = "admin.babyQuiz.";

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
        $babyQuiz = BabyQuiz::where('status', '=', '1')->latest()->get();
        $data = [
            'title1' => 'Baby Quiz',
            'title2' => 'Quiz',
            'babyQuiz' => $babyQuiz
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
            'title1' => 'Add baby Quiz',
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
            'answer' => 'required|string|max:1',
            'image' => 'required|max:1999|mimes:jpeg,jpg,png,webp,gif'
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quiz_baby_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/quiz/baby', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noImage;
        }

        $babyQuiz = new BabyQuiz;
        $babyQuiz->question = $request->input('question');
        $babyQuiz->optionA = $request->input('optionA');
        $babyQuiz->optionB = $request->input('optionB');
        $babyQuiz->optionC = $request->input('optionC');
        $babyQuiz->tip = $request->input('tip');
        $babyQuiz->answer = $request->input('answer');
        $babyQuiz->image = $fileNameToStore;
        $babyQuiz->save();

        return redirect()->route('babyquiz.index')->with('success', "Question added");
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
            return redirect()->route('babyquiz.index')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Baby Quiz',
            'title2' => 'Quiz',
            'babyQuiz' => $babyQuiz
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
        $babyQuiz = BabyQuiz::find($id);
        if(empty($babyQuiz) || $babyQuiz->status == 0) {
            return redirect()->route('babyquiz.index')->with('error', "Question does not exist.");
        }
        $data = [
            'title1' => 'Edit Quiz',
            'title2' => 'Edit',
            'babyQuiz' => $babyQuiz
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
            'answer' => 'required|string|max:1',
            'image' => 'nullable|max:1999|mimes:jpeg,jpg,png,webp,gif'
        ]);

        $babyQuiz = BabyQuiz::find($id);
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = 'quiz_baby_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('image')->storeAs('public/quiz/baby', $fileNameToStore);
            if($babyQuiz->image != $this->noImage) {
                Storage::delete("public/quiz/baby/".$babyQuiz->image);
            }
            $babyQuiz->image = $fileNameToStore;
        }

        $babyQuiz->question = $request->input('question');
        $babyQuiz->optionA = $request->input('optionA');
        $babyQuiz->optionB = $request->input('optionB');
        $babyQuiz->optionC = $request->input('optionC');
        $babyQuiz->tip = $request->input('tip');
        $babyQuiz->answer = $request->input('answer');
        $babyQuiz->save();

        return redirect()->route('babyquiz.show', $id)->with('success', "Question updated");
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
        if(!empty($babyQuiz->image) && $babyQuiz->image != $this->noImage) {
            Storage::delete('public/quiz/baby/'.$babyQuiz->image);
        }
        $babyQuiz->save();
        return redirect()->route('babyquiz.index')->with('success', 'Question deleted');
    }
}
