<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\UserActing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\UserAddress;
use App\Models\UserClipping;
use App\Models\UserFile;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function registerProfile(Request $request)
    {
        // dd($request);

        $user = Auth::user();

        UserProfile::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'representative' => $request->input('representative'),
            'cnpj' => $request->input('cnpj'),
            'cpf' => $request->input('cpf'),
            'phone' => $request->input('phone'),

            'gender' => $request->input('gender'),
            'race' => $request->input('race'),
            'pcd' => $request->input('pcd'),

            'website' => $request->input('website'),
            'film_friendly_network' => $request->input('film_friendly_network')
        ]);
        UserAddress::create([
            'user_id' => $user->id,
            'address' => $request->input('address'),
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'state_registration' => $request->input('state_registration'),
            'municipal_registration' => $request->input('municipal_registration')
        ]);

        UserActing::create([
            'user_id' => $user->id,
            'acting_id' => $request->input('acting'),
        ]);

        foreach ($request->clips as $clip) {
            UserClipping::create([
                'user_id' => $user->id,
                'clipping' => $clip['value'],
            ]);
        }

        function processUpload($file, $user, $type)
        {
            if ($file) {
                $userFile = new UserFile();
                $userFile->user_id = $user->id;
                $userFile->name = $file->getClientOriginalName();
                $userFile->type = $type;
                $userFile->extension = $file->getClientOriginalExtension();
                $path = $file->store("files/{$user->id}/{$type}");
                $userFile->path = $path;
                $userFile->save();
            }
        }

        processUpload($request->file('curriculum'), $user, 'curriculum');
        processUpload($request->file('proof_of_address'), $user, 'proof_of_address');
        processUpload($request->file('rg_front'), $user, 'rg_front');
        processUpload($request->file('rg_back'), $user, 'rg_back');

        return redirect()->route('home');
    }
}
