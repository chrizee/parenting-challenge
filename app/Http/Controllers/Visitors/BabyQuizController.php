<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BabyQuiz;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEbookToUser;
use App\Pages;

class BabyQuizController extends Controller

{
    private $viewPath = "public.";
    private $noOfQuesInQuiz;
    private $duraionOfQuiz;        //time in mins

    public function __construct()
    {
        $pages = Pages::latest()->take(1)->get();
        $pages = (empty($pages[0])) ? $pages : $pages[0];
        $this->noOfQuesInQuiz = empty($pages->baby_quiz_ques) ? 10 : $pages->baby_quiz_ques;
        $this->duraionOfQuiz = empty($pages->baby_quiz_time) ? 10 : $pages->baby_quiz_time;
    }

    /**
     * Shows the questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $babyQuiz = BabyQuiz::where('status', '1')->get()->shuffle()->random($this->noOfQuesInQuiz);
        $answer = array();
        foreach ($babyQuiz as $key => $value) {
            $answer[$value->id] = $value->answer;
        }
        $data = [
            'babyQuiz' => $babyQuiz,
            'answer' => json_encode($answer),
            'progressBarColors' => ['primary', 'success', 'warning'],
            'duration' => $this->duraionOfQuiz
        ];
        return view($this->viewPath.'babyquiz')->with($data);
    }

    /**
     * Marks the question submitted by the user.
     *
     * @return \Illuminate\View\View
     */
    public function mark(Request $request)
    {
        $answers = $request->except('_token');
        $correct = 0;
        $babyQuiz = [];
        foreach($answers as $key => $value) {
            $quiz = BabyQuiz::find($key);
            if(!empty($quiz) && $quiz->status == 1) {
                array_push($babyQuiz, $quiz);
                if(!empty($value) && $quiz->answer == $value) {
                    $quiz->right++;
                    $correct++;
                }else {
                    $quiz->wrong++;
                }
                $quiz->save();
            }
        }
        $data = [
            'score' => $correct,
            'total' => $this->noOfQuesInQuiz,
            'percent' => round(($correct/$this->noOfQuesInQuiz) * 100),
            'progressBarColors' => ['primary', 'success', 'warning'],
            'babyQuiz' => $babyQuiz,
            'answersFromUser' => $answers
        ];
        return view($this->viewPath.'babyquizscore')->with($data);
    }

    public function sendEbook(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email'
        ]);
        //get the random ebook here;
        $ebookUrl = asset("storage/pdf/The_most_common_parenting_mistakes_ever_DrAnishNRK.pdf");
        Mail::to($request->input('email'))->send(new SendEbookToUser($ebookUrl));
        return redirect()->route('index')->with('success', "Check your inbox within the next 24hrs to download the e-book");
    }
}