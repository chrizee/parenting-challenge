<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Pages;

class PagesController extends Controller
{
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
            'title2' => 'Register'
        ];
        return view('auth.register')->with($title);
    }
    //handle about use requests
    public function setting() {
        $pages = Pages::latest()->take(1)->get();
        $data = [
            'title1' => 'Settings',
            'title2' => 'settings',
            'pages' => (empty($pages[0])) ? $pages : $pages[0]
        ];
        return view('admin.about')->with($data);
    }

    //stores the about us field
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
        return redirect('admin/settings')->with('success', "Setting Saved");
    }

    //updates the about us field
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
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'password' => 'nullable|string|min:6|confirmed',
            'pic' => 'image|nullable|max:1999'
        ]);
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
        return redirect('admin/profile')->with('success', 'Profile updated');
    }

    public function adverts() {
        $title = [
            'title1' => 'Adverts',
            'title2' => 'Advert'
        ];
        return view('admin.advert')->with($title);
    }

    public function slider() {
        $title = [
            'title1' => 'Sliders',
            'title2' => 'Sliders'
        ];
        return view('admin.slider')->with($title);
    }
}
