<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Activity;

class WidgetController extends Controller
{
    public function index()
    {
        $activity = Activity::all();
        return Inertia::render('dashboard',['activity'=>$activity]);
    }
}
