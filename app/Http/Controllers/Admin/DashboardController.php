<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function users()
    {
        return Inertia::render('Admin/Pages/Users');
    }
    public function actings()
    {
        return Inertia::render('Admin/Pages/Actings');
    }

    public function addActing(Request $request)
    {
        Acting::create([
            'acting' => $request->input('acting'),
        ]);
    }
}
