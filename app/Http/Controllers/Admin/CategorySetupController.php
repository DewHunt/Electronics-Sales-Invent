<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorySetupController extends Controller
{
    public function index()
    {
    	$title = "Category Setup";

    	return view('admin.categorySetup.index')->with(compact('title'));
    }
}
