<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BabyQuiz;

class BabyQuizController extends Controller

{
    private $viewPath = "public.";
    /**
     * Shows the questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $babyQuiz = BabyQuiz::where('status', '1')->get()->shuffle()->random(10);
        $answer = array();
        foreach ($babyQuiz as $key => $value) {
            $answer[$value->id] = $value->answer;
        }
        $data = [
            'babyQuiz' => $babyQuiz,
            'answer' => json_encode($answer),
            'progressBarColors' => ['primary', 'success', 'warning']
        ];
        return view($this->viewPath.'babyquiz')->with($data);
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
            $quiz = BabyQuiz::find($key);
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
        return view($this->viewPath.'babyquizscore')->with($data);
    }

    public function sendEbook()
    {
        //logic to send email to email
        return redirect()->route('index')->with('success', "Check your inbox within the next 24hrs to download the e-book");
    }
}