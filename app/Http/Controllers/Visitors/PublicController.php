<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChildPsychology;
use App\ParentPsychology;

class PublicController extends Controller
{
    protected $viewPath = 'public.';

    public function index() {

        return view($this->viewPath."index");
    }

    public function childPsychologies() {
        $childPsychologies = ChildPsychology::latest()->where('status', '=', '1')->paginate(9);
        $data = [
          'childPsychologies' => $childPsychologies,
        ];
        return view($this->viewPath."childpsychologies")->with($data);
    }

    public function childPsychology($id) {
        $childPsychology = ChildPsychology::find($id);
        //check if quote is valid before returning view
        if($childPsychology->status == '0') {
            return redirect()->route('psychologies.child')->with('error', 'Quote does not exist');
        }
        $data = [
            'childPsychology' => $childPsychology,
        ];
        return view($this->viewPath."childpsychology")->with($data);
    }

    public function parentPsychology() {

    }
}
