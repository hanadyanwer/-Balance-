<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function workouts()
    {
        return view('workouts');
    }

    public function services()
    {
        return view('services');
    }

    public function dailyPlan()
    {
        return view('daily-plan');
    }

    public function recipes()
    {
        return view('Recipes');
    }

    public function profile()
    {
        return view('profile');
    }

    public function logout()
    {
        return view('logout');
    }

    public function index()
    {
        return view('index');
    }

    public function reset()
    {
        return view('reset');
    }
}
