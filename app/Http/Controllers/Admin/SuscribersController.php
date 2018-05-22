<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Suscribers;
use Illuminate\Http\Request;

class SuscribersController extends Controller
{
    /**
     * Sets path to views directory
     *
     * @var string
     */
    private $viewPath = 'admin.suscribers.';

    /**
     * Registers a middleware in this controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suscribers = Suscribers::latest()->get();
        $data = [
            'title1' => "Suscribers",
            'title2' => "suscribers",
            'suscribers' => $suscribers
        ];
        return view($this->viewPath.'index')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suscribers  $suscribers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscribers $suscribers, $id)
    {
        $suscriber = Suscribers::find($id);
        if($request->has('mute')) {
            $suscriber->mute = '0';
        }
        if($request->has('unmute')) {
            $suscriber->mute = '1';
        }
        $suscriber->save();
        return redirect()->route('suscribers.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suscriber = Suscribers::find($id);
        $suscriber->delete();
        return redirect()->route('suscribers.index')->with('success', 'Deleted successfully');
    }
}
