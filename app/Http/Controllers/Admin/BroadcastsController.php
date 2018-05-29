<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Broadcast;
use App\Mail\Broadcast as BroadcastMail;
use Illuminate\Support\Facades\Mail;
use App\Subscribers;


class BroadcastsController extends Controller
{
    private $viewPath = "admin.broadcast.";
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
        $broadcasts = Broadcast::where('status', '1')->latest()->get();
        $data = [
            'title1' => 'Broadcasts',
            'title2' => 'Broadcast',
            'broadcasts' => $broadcasts
        ];
        return view($this->viewPath."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string'
        ]);

        $broadcast = new Broadcast;
        $broadcast->message = $request->input('message');
        $broadcast->save();

        //get subcribers
        $subcribers = Subscribers::where([['status', '=', '1'],['mute', '=', '1']])->get();
        Mail::to($subcribers)->send( new BroadcastMail($request->input('message')));
        return redirect()->route('broadcast.index')->with('success', "Broadcast queued for sending");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
