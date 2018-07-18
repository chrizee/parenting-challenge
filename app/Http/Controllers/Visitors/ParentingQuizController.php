<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\ParentingQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEbookToUser;
use App\Pages;

class ParentingQuizController extends Controller
{
    private $viewPath = "public.";
    private $noOfQuesInQuiz;
    private $duraionOfQuiz;

    public function __construct()
    {
        $pages = Pages::latest()->take(1)->get();
        $pages = (empty($pages[0])) ? $pages : $pages[0];
        $this->noOfQuesInQuiz = empty($pages->parent_quiz_ques) ? 10 : $pages->parent_quiz_ques;
        $this->duraionOfQuiz = empty($pages->parent_quiz_time) ? 10 : $pages->parent_quiz_time;
    }
    /**
     * Shows the questions.
     *
     */
    public function index()
    {
        $parentingQuiz = ParentingQuiz::where('status', '1')->get()->shuffle()->random($this->noOfQuesInQuiz);
        $answer = array();
        foreach ($parentingQuiz as $key => $value) {
            $answer[$value->id] = $value->answer;
        }
        $data = [
            'parentingQuiz' => $parentingQuiz,
            'answer' => json_encode($answer),
            'progressBarColors' => ['primary', 'success', 'warning'],
            'duration' => $this->duraionOfQuiz
        ];
        return view($this->viewPath.'parentingquiz')->with($data);
    }

    /**
     * Marks the question submitted by the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function mark(Request $request)
    {
        $answers = $request->except('_token');
        $correct = 0;
        $parentingQuiz = [];
        foreach($answers as $key => $value) {
            $quiz = ParentingQuiz::find($key);
            if(!empty($quiz) && $quiz->status == 1) {
                array_push($parentingQuiz, $quiz);
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
            'progressBarColors' => ['primary', 'success', 'warning'],
            'percent' => round(($correct/$this->noOfQuesInQuiz) * 100),
            'parentingQuiz' => $parentingQuiz,
            'answersFromUser' => $answers
        ];
        return view($this->viewPath.'parentingquizscore')->with($data);
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