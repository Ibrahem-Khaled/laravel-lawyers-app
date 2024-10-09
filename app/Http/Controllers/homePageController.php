<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class homePageController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'active')->get();
        $plans = Subscription::all();
        return view('home', compact('users', 'plans'));
    }
}
