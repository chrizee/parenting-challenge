<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ChildPsychology;
use App\ParentPsychology;
use App\ParentingTips;
use App\PregnancyTips;
use App\BabyFacts;
use App\Quote;
use App\Advert;
use App\Subscribers;
use App\Pages;
use App\Mail\SubscriberRegistered;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    protected $viewPath = 'public.';

    public function index() {
        $quotes = Quote::where('status', '1')->get()->shuffle()->random(3);
        $babyFacts = BabyFacts::where('status', '1')->get()->shuffle()->random(3);
        $parentingTips = ParentingTips::where('status', '1')->get()->shuffle()->random(3);
        $ads = Advert::where('status', '1')->take(3)->get();
        $data = [
            'quotes' => $quotes,
            'babyFacts' => $babyFacts,
            'parentingTips' => $parentingTips,
            'ads' => $ads
        ];
        return view($this->viewPath."index")->with($data);
    }

    public function contact() {
        $data = [
            'title1' => 'Settings',
            'title2' => 'settings',
        ];
        return view($this->viewPath."contact")->with($data);
    }

    public function mail(Request $request) {
        Validator::make($request->all(), [
            'name' => ['required', 'string' ],
            'email' => ['required', 'email'],
            'message' => ['required', 'string']
        ])->validate();
        //send message to admin here
        $pages = Pages::latest()->take(1)->get();
        $page = (empty($pages[0])) ? $pages : $pages[0];
        Mail::to($page->email)->send( new ContactUs($request));
        return redirect()->route('contact')->with('success', "Your message has been recieved and will be replied soonest.");
    }

    public function childPsychologies() {
        $childPsychologies = ChildPsychology::latest()->where('status', '=', '1')->paginate(9);
        $data = [
          'childPsychologies' => $childPsychologies,
        ];
        return view($this->viewPath."childpsychologies")->with($data);
    }

    public function childPsychology($id) {
        $childPsychology = ChildPsychology::find(decrypt($id));
        //check if quote is valid before returning view
        if(empty($childPsychology) || $childPsychology->status == '0') {
            return redirect()->route('psychologies.child')->with('error', 'Quote does not exist');
        }
        $data = [
            'childPsychology' => $childPsychology,
        ];
        return view($this->viewPath."childpsychology")->with($data);
    }

    public function parentPsychologies() {
        $parentPsychologies = ParentPsychology::latest()->where('status', '=', '1')->paginate(9);
        $data = [
            'parentPsychologies' => $parentPsychologies,
        ];
        return view($this->viewPath."parentpsychologies")->with($data);
    }

    public function parentPsychology($id) {
        $parentPsychology = ParentPsychology::find(decrypt($id));
        //check if quote is valid before returning view
        if(empty($parentPsychology) || $parentPsychology->status == '0') {
            return redirect()->route('psychologies.parent')->with('error', 'Quote does not exist');
        }
        $data = [
            'parentPsychology' => $parentPsychology,
        ];
        return view($this->viewPath."parentpsychology")->with($data);
    }

    public function parentingTips() {
        $parentingTips = ParentingTips::latest()->where('status', '=', '1')->paginate(9);
        $data = [
            'parentingTips' => $parentingTips,
        ];
        return view($this->viewPath."parentingtips")->with($data);
    }

    public function parentingTip($id) {
        $parentingTip = ParentingTips::find(decrypt($id));
        //check if tip is valid before returning view
        if(empty($parentingTip) || $parentingTip->status == '0') {
            return redirect()->route('tips.parent')->with('error', 'Tip does not exist');
        }
        $data = [
            'parentingTip' => $parentingTip,
        ];
        return view($this->viewPath."parentingtip")->with($data);
    }

    public function pregnancyTips() {
        $pregnancyTips = PregnancyTips::latest()->where('status', '=', '1')->paginate(9);
        $data = [
            'pregnancyTips' => $pregnancyTips,
        ];
        return view($this->viewPath."pregnancytips")->with($data);
    }

    public function pregnancyTip($id) {
        $pregnancyTip = PregnancyTips::find(decrypt($id));
        //check if tip is valid before returning view
        if(empty($pregnancyTip) || $pregnancyTip->status == '0') {
            return redirect()->route('tips.pregnancy')->with('error', 'Tip does not exist');
        }
        $data = [
            'pregnancyTip' => $pregnancyTip,
        ];
        return view($this->viewPath."pregnancytip")->with($data);
    }

    public function babyFacts() {
        $babyFacts = BabyFacts::latest()->where('status', '=', '1')->paginate(9);
        $data = [
            'babyFacts' => $babyFacts,
        ];
        return view($this->viewPath."babyfacts")->with($data);
    }

    public function babyFact($id) {
        $babyFact = BabyFacts::find(decrypt($id));
        //check if tip is valid before returning view
        if(empty($babyFact) || $babyFact->status == '0') {
            return redirect()->route('facts.baby')->with('error', 'Fact does not exist');
        }
        $data = [
            'babyFact' => $babyFact,
        ];
        return view($this->viewPath."babyfact")->with($data);
    }

    public function quotes() {
        $quotes = Quote::latest()->where('status', '=', '1')->paginate(9);
        $data = [
            'quotes' => $quotes,
        ];
        return view($this->viewPath."quotes")->with($data);
    }

    public function subscribe(Request $request) {
        $this->validate($request, [
            'email' => "bail|required|email|max:191|unique:suscribers",
        ]);
        $subscriber = Subscribers::create(['email' => $request->input('email')]);

        Mail::to($subscriber)->send(new SubscriberRegistered($subscriber));
        return redirect()->route('index')->with('success', "Thank you for subscribing");
    }

    public function destroySubscriber($id)
    {
        Subscribers::destroy(decrypt($id));
        return redirect()->route('index')->with('success', 'You have successfully unsubscribed from our weekly tips/facts');
    }

    public function sendMail() {
        Mail::send(new SubscriberRegistered());
    }
}
