<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admaindash');
    }

    public function dailyAdmin()
    {
        return view('admaindaily');
    }

    public function workoutAdmin()
    {
        return view('admainwork');
    }

    public function drinksAdmin()
    {
        return view('admindrink');
    }

    public function recipesAdmin()
    {
        return view('adminrecipes');
    }

    public function tipsAdmin()
    {
        return view('admintips');
    }

    public function loginAdmin()
    {
        return view('admainlog');
    }

    public function resetAdmin()
    {
        return view('admainreset');
    }
}
