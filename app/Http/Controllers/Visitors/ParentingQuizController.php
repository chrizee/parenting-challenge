<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\ParentingQuiz;
use App\Http\Controllers\Controller;

class ParentingQuizController extends Controller
{
    private $viewPath = "public.";

    /**
     * Shows the questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentingQuiz = ParentingQuiz::where('status', '1')->get()->shuffle()->random(10);
        $answer = array();
        foreach ($parentingQuiz as $key => $value) {
            $answer[$value->id] = $value->answer;
        }
        $data = [
            'parentingQuiz' => $parentingQuiz,
            'answer' => json_encode($answer),
            'progressBarColors' => ['primary', 'success', 'warning']
        ];
        return view($this->viewPath.'parentingquiz')->with($data);
    }

    /**
     * Marks the question submitted by the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function mark(Request $request)
    {
        $answers = $request->except('_token');
        $correct = 0;
        foreach($answers as $key => $value) {
            $quiz = ParentingQuiz::find($key);
            if(!empty($quiz) && $quiz->status == 1) {
                if($quiz->answer == $value) {
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
            'total' => count($answers),
            'percent' => round(($correct/count($answers)) * 100)
        ];
        return view($this->viewPath.'parentingquizscore')->with($data);
    }

    public function sendEbook(Request $request)
    {
        //logic to send email to email
        return redirect()->route('index')->with('success', "Check your inbox within the next 24hrs to download the e-book");
    }
}