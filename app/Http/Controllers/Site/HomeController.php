<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use App\Models\UserFile;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Acting;
use App\Models\UserActing;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user()->load('profile', 'address', 'actings.acting', 'files', 'clippings');
        $cpfs = UserProfile::pluck('cpf');
        return Inertia::render('User/Home', [
            'user' => $user,
            'cpfs' => $cpfs
        ]);
    }

    public function logisticService($id)
    {
        $user = Auth::user()->load('profile', 'address', 'actings.acting', 'files', 'clippings');

        $acting = Acting::with('users')
            ->findOrFail($id);

        return Inertia::render('User/LogisticService', [
            'user' => $user,
            'acting' => $acting
        ]);
    }

    public function specializedService($id)
    {
        $user = Auth::user()->load('profile', 'address', 'actings.acting', 'files', 'clippings');

        $acting = Acting::with('users')
            ->findOrFail($id);

        return Inertia::render('User/SpecializedService', [
            'user' => $user,
            'acting' => $acting
        ]);
    }
}
