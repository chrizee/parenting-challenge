<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Pages;
use App\Advert;

class PagesController extends Controller
{
    /*
     * Number of adverts to allow in application.
     * change here and everything will take shap in view and database
     *
     * @var int
     */
    protected $numberOfAds = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        $title = [
            'title1' => 'Dashboard',
            'title2' => 'Dashboard'
        ];
        return view('admin.dashboard')->with($title);
    }

    public function registerAdmin() {
        $title = [
            'title1' => 'Register',
            'title2' => 'Register',
        ];
        return view('auth.register')->with($title);
    }
    //handle settings requests
    public function setting() {
        $pages = Pages::latest()->take(1)->get();
        $data = [
            'title1' => 'Settings',
            'title2' => 'settings',
            'pages' => (empty($pages[0])) ? $pages : $pages[0]
        ];
        return view('admin.about')->with($data);
    }

    //stores the setting field
    public function storeSetting(Request $request) {
        if(empty((Pages::all())->id)) {
            $pages = new Pages;
        }else {
            $id = Pages::latest()->take(1)->get()[0]->id;
            $pages = Pages::find($id);
        }
        if($request->has('aboutAdd')) {
            $this->validate($request, [
                'about' => 'required|string'
            ]);
            $pages->about = $request->input('about');
            $pages->save();
        }
        if($request->has('contactAdd')) {
            $this->validate($request, [
                'facebook' => 'nullable|url',
                'twitter' => 'nullable|url',
                'instagram' => 'nullable|url',
                'googleplus' => 'nullable|url',
                'email' => 'nullable|email',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
            ]);
            $pages->facebook = ($request->has('facebook')) ? $request->input('facebook') : '';
            $pages->twitter = ($request->has('twitter')) ? $request->input('twitter') : '';
            $pages->instagram = ($request->has('instagram')) ? $request->input('instagram') : '';
            $pages->googleplus = ($request->has('googleplus')) ? $request->input('googleplus') : '';
            $pages->email = ($request->has('email')) ? $request->input('email') : '';
            $pages->phone = ($request->has('phone')) ? $request->input('phone') : '';
            $pages->address = ($request->has('address')) ? $request->input('address') : '';
            $pages->save();
        }
        if($request->has('quizAdd')) {
            $this->validate($request, [
                'baby_quiz_ques' => 'required|numeric',
                'baby_quiz_time' => 'required|numeric',
                'parent_quiz_ques' => 'required|numeric',
                'parent_quiz_time' => 'required|numeric',
                'parentingquizstart' => 'required|string',
                'babyquizstart' => 'required|string'
            ]);
            $pages->baby_quiz_ques = $request->input('baby_quiz_ques');
            $pages->baby_quiz_time = $request->input('baby_quiz_time');
            $pages->parent_quiz_ques = $request->input('parent_quiz_ques');
            $pages->parent_quiz_time = $request->input('parent_quiz_time');
            $pages->parentingquizstart = $request->input('parentingquizstart');
            $pages->babyquizstart = $request->input('babyquizstart');
            $pages->save();
        }
        return redirect('admin/settings')->with('success', "Setting Saved");
    }
    //updates the setting field
    public function updateSetting(Request $request) {
        $id = Pages::latest()->take(1)->get()[0]->id;
        $pages = Pages::find($id);

        if($request->has('aboutEdit')) {
            $this->validate($request, [
                'about' => 'required|string'
            ]);
            $pages->about = $request->input('about');
            $pages->save();
        }
        if($request->has('contactEdit')) {
            $this->validate($request, [
                'facebook' => 'nullable|url',
                'twitter' => 'nullable|url',
                'instagram' => 'nullable|url',
                'googleplus' => 'nullable|url',
                'email' => 'nullable|email',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
            ]);
            $pages->facebook = ($request->has('facebook')) ? $request->input('facebook') : '';
            $pages->twitter = ($request->has('twitter')) ? $request->input('twitter') : '';
            $pages->instagram = ($request->has('instagram')) ? $request->input('instagram') : '';
            $pages->googleplus = ($request->has('googleplus')) ? $request->input('googleplus') : '';
            $pages->email = ($request->has('email')) ? $request->input('email') : '';
            $pages->phone = ($request->has('phone')) ? $request->input('phone') : '';
            $pages->address = ($request->has('address')) ? $request->input('address') : '';
            $pages->save();
        }
        if($request->has('quizEdit')) {
            $this->validate($request, [
                'baby_quiz_ques' => 'required|numeric',
                'baby_quiz_time' => 'required|numeric',
                'parent_quiz_ques' => 'required|numeric',
                'parent_quiz_time' => 'required|numeric',
                'parentingquizstart' => 'required|string',
                'babyquizstart' => 'required|string'
            ]);
            $pages->baby_quiz_ques = $request->input('baby_quiz_ques');
            $pages->baby_quiz_time = $request->input('baby_quiz_time');
            $pages->parent_quiz_ques = $request->input('parent_quiz_ques');
            $pages->parent_quiz_time = $request->input('parent_quiz_time');
            $pages->parentingquizstart = $request->input('parentingquizstart');
            $pages->babyquizstart = $request->input('babyquizstart');
            $pages->save();
        }
        return redirect('admin/settings')->with('success', "Setting updated");
    }

    public function profile() {
        $data = [
            'title1' => 'Profile',
            'title2' => 'profile'
        ];
        return view('auth.profile')->with($data);
    }

    public function updateProfile(Request $request) {
        //custom validator to the email bug in updated an already existing email
        Validator::make($request->all(), [
            'email' => [
                'bail',
                'required',
                'email',
                'max:191',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'name' => 'bail|required|string|max:191',
            'password' => 'bail|nullable|string|min:6|confirmed',
            'pic' => 'bail|image|nullable|max:1999'
        ])->validate();
        //returns back if validation fails or use the validate() method on the instance of the Validator as done above
        /*if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }*/

        $user = auth()->user();
        if($request->hasFile('pic')) {
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNameToStore = 'user_'.time().'.'.$extension; //make he filename unique
            $path = $request->file('pic')->storeAs('public/user_images', $fileNameToStore);
            if($user->pic != $this->noUser) {
                Storage::delete("public/user_images/".$user->pic);
            }
            $user->pic = $fileNameToStore;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile updated');
    }

    public function adverts() {
        $ads = Advert::where('status', '=', '1')->get();
        $data = [
            'title1' => 'Adverts',
            'title2' => 'Advert',
            'noOfAds' => $this->numberOfAds,
            'adverts' => $ads
        ];
        return view('admin.advert')->with($data);
    }

    public function storeAdverts(Request $request) {
        Validator::make($request->all(), [
            'heading' => 'string|required',
            'ad' => 'string|required|',
            'link' => 'required|url',
            'button_text' => 'required|string',
            'image' => 'required|max:1999|mimes:jpeg,jpg,png,webp,gif'
        ])->validate();
        $ad = new Advert;
        if($request->hasFile('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "advert_".time().".".$extention;
            $request->file('image')->storeAs('public/adverts', $fileNameToStore);
            $ad->image = $fileNameToStore;
        }
        $ad->heading = $request->input('heading');
        $ad->ad = $request->input('ad');
        $ad->link = $request->input('link');
        $ad->button_text = $request->input('button_text');
        $ad->save();
        return redirect()->route('adverts')->with('success', 'Advert added successfully');
    }

    public function updateAdverts(Request $request, $id) {
        Validator::make($request->all(), [
            'heading' => 'string|required',
            'ad' => 'string|required|',
            'link' => 'required|url',
            'button_text' => 'required|string',
            'image' => 'max:1999|mimes:jpeg,jpg,png,webp,gif',
            'deletePic' => 'boolean'
        ])->validate();
        $ad = Advert::find($id);

        if($request->input('deletePic')) {
            Storage::delete('public/adverts/'.$ad->image);
            $ad->image = '';
        }

        if($request->hasFile('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "advert_".time().".".$extention;
            $request->file('image')->storeAs('public/adverts', $fileNameToStore);
            if(!empty($ad->image)) {
                Storage::delete('public/adverts/'.$ad->image);
            }
            $ad->image = $fileNameToStore;
        }

        $ad->heading = $request->input('heading');
        $ad->ad = $request->input('ad');
        $ad->button_text = $request->input('button_text');
        $ad->link = $request->input('link');
        $ad->save();
        return redirect()->route('adverts')->with('success', 'Advert updated successfully');
    }

}
