<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Dashboard";
        return view('admin.index')->with(compact('title'));
        // return view('home');
    }


    public function message_md()
    {
        return view('admin.settings.message_md');
    }

    public function message_md_ajax(Request $request)
    {
        \App\helperClass::_writeNammedFile($request->message, 'message_md.txt');

        return redirect(route('settings.message_md'))->with('message', 'updated successfully');
    }
}
