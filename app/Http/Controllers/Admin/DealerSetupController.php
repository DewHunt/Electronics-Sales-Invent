<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\TerritorySetup;

class DealerSetupController extends Controller
{
    public function index()
    {
    	$title = "Dealer Setup";

    	$dealers = DealerSetup::orderBy('name','asc')->get();

    	return view('admin.dealerSetup.index')->with(compact('title','dealers'));
    }

    public function add()
    {
    	$title = "Add Dealer";
    	$formLink = "dealerSetup.save";
    	$buttonName = "Save";

    	$territories = TerritorySetup::orderBy('name','asc')->get();

    	return view('admin.dealerSetup.add')->with(compact('title','formLink','buttonName','territories'));
    }
}
