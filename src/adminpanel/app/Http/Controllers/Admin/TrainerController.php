<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Trainer;

class TrainerController extends Controller
{
    //
    public function index()
    {
    	$trainers = Trainer::all();
    	return view('admin.trainer' , compact('trainers'));
    }

    public function show($id)
    {
    	$trainer = Trainer::find($id);
    	return view('admin.trainerdetails', compact('trainer'));
    }
}
