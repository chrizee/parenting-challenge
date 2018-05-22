<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\BabyQuiz;
use App\ParentingQuiz;
use App\ChildPsychology;
use App\ParentPsychology;
use App\ParentingTips;
use App\BabyFacts;
use App\Quote;

class StoreJSONFilesInDBController extends Controller
{
    public function storeBabyQuiz() {
        $content = Storage::get("public/Parentingiq/Babyquiz/babyquizes.json");
        //return $content;
        $content = explode('],', $content);
        //return $content;
        foreach ($content as $value) {
            $value =  str_replace('[', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $babyQuiz = new BabyQuiz;
            $babyQuiz->question = "<p>".trim(substr_replace(explode('=>', $arr[1])[1], '', 1, 1)).'</p>';
            $babyQuiz->optionA = trim(substr_replace(explode('=>', $arr[2])[1], '',1,1));
            $babyQuiz->optionB = trim(substr_replace(explode('=>', $arr[3])[1], '',1,1));
            $babyQuiz->optionC = trim(substr_replace(explode('=>', $arr[4])[1], '', 1,1));
            $babyQuiz->tip = trim(substr_replace(explode('=>', $arr[6])[1], '',1,1));
            $babyQuiz->answer = trim(substr_replace(explode('=>', $arr[5])[1], '', 1,1));
            $image = trim(substr_replace(explode('=>', $arr[7])[1], '', 1,1));
            $babyQuiz->image = substr_replace($image, '',-1, 1);
            $babyQuiz->save();
        }
        return "finished";
    }

    public function storeParentingQuiz() {
        $content = Storage::get("public/Parentingiq/questions.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        $img = [];
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $parentingQuiz = new ParentingQuiz;
            $parentingQuiz->question = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $parentingQuiz->optionA = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $parentingQuiz->optionB = trim(substr_replace(explode('=>', $arr[2])[1], '',1,1));
            $parentingQuiz->optionC = trim(substr_replace(explode('=>', $arr[3])[1], '', 1,1));
            $parentingQuiz->answer = trim(substr_replace(explode('=>', $arr[4])[1], '', 1,1));
            $parentingQuiz->image = trim(substr_replace(explode('=>', $arr[5])[1], '', 1,1));
            $img[] = explode('.', $parentingQuiz->image)[0];
            $parentingQuiz->tip = trim(substr_replace(explode('=>', $arr[6])[1], '',1,1));
            $description = trim(substr_replace(explode('=>', $arr[7])[1], '',1,1));
            $parentingQuiz->description = substr_replace($description, '', -1, 1);
            $parentingQuiz->save();
        }
        //get the images used for the parenting quiz to put them in the folder
        //this code below made be realized he used all 45 images in the folder
        $image = array_unique($img);
        //return count($image);
        foreach ($image as $value) {
            //echo $value.',';
        }
        return "finished";
    }

    public function storeChildPsychology() {
        $content = Storage::get("public/Parentingiq/childpsychology.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        $img = [];
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $childPsychology = new ChildPsychology;
            $childPsychology->quote = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $image = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $childPsychology->image = substr_replace($image, '', -1, 1);
            $img[] = explode('.', $childPsychology->image)[0];
            $childPsychology->save();
        }
        //get the images used for the parenting quiz to put them in the folder
        //this code below made be realized he used all 45 images in the folder
        $image = array_unique($img);
        //return count($image);
        foreach ($image as $value) {
            //echo $value.',';
        }
        return "finished";
    }

    public function storeParentPsychology() {
        $content = Storage::get("public/Parentingiq/parentpsychology.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        $img = [];
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $parentPsychology = new ParentPsychology;
            $parentPsychology->quote = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $image = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $parentPsychology->image = substr_replace($image, '', -1, 1);
            $img[] = explode('.', $parentPsychology->image)[0];
            $parentPsychology->save();
        }
        //get the images used for the parenting quiz to put them in the folder
        //this code below made be realized he used all 45 images in the folder
        $image = array_unique($img);
        //return count($image);
        foreach ($image as $value) {
            //echo $value.',';
        }
        return "finished";
    }

    public function storeParentingTips() {
        $content = Storage::get("public/Parentingiq/parentingtips.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        $img = [];
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $parentingTips = new ParentingTips;
            $parentingTips->tip = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $image = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $parentingTips->image = substr_replace($image, '', -1, 1);
            $img[] = explode('.', $parentingTips->image)[0];
            $parentingTips->save();
        }
        //get the images used for the parenting quiz to put them in the folder
        //this code below made be realized he used all 45 images in the folder
        $image = array_unique($img);
        //return count($image);
        foreach ($image as $value) {
            //echo $value.',';
        }
        return "finished";
    }

    public function storeBabyFacts() {
        $content = Storage::get("public/Parentingiq/doyouknowfacts.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        $img = [];
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $babyFacts = new BabyFacts;
            $babyFacts->fact = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $image = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $babyFacts->image = substr_replace($image, '', -1, 1);
            $img[] = explode('.', $babyFacts->image)[0];
            $babyFacts->save();
        }
        //get the images used for the parenting quiz to put them in the folder
        //this code below made be realized he used all 45 images in the folder
        $image = array_unique($img);
        //return count($image);
        foreach ($image as $value) {
            //echo $value.',';
        }
        return "finished";
    }

    public function storeQuotes() {
        $content = Storage::get("public/Parentingiq/quotes.json");
        //return $content;
        $content = explode('},', $content);
        //return $content;
        foreach ($content as $value) {
            $value =  str_replace('{', '',$value);
            //return $value;
            $arr = explode('",', $value);
            //return $arr;
            $quote = new Quote;
            $quote->quote = "<p>".trim(substr_replace(explode('=>', $arr[0])[1], '', 1, 1)).'</p>';
            $person = trim(substr_replace(explode('=>', $arr[1])[1], '',1,1));
            $quote->person = substr_replace($person, '', -1, 1);
            $quote->save();
        }
        return "finished";
    }
}
