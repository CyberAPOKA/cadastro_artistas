<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acting;
use App\Models\User;
use App\Models\UserProfile;

class ApiController extends Controller
{
    public function getActings(Request $request)
    {
        $actings = Acting::all();

        return [
            'actings' => $actings
        ];
    }

    //admin
    public function getActingsInAdmin(Request $request)
    {
        $actings = Acting::when($request->acting, function ($query, $acting) {
            return $query->where('acting', 'LIKE', '%' . $acting . '%');
        })

            ->orderBy('actings.id')
            ->paginate(10);

        return [
            'actings' => $actings
        ];
    }

    public function getUsers(Request $request)
    {
        $users = User::with('profile', 'address')
            ->when($request->email, function ($query, $email) {
                return $query->where('email', 'LIKE', '%' . $email . '%');
            })
            ->when($request->name, function ($query, $name) {
                return $query->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->where('user_profiles.name', 'LIKE', '%' . $name . '%');
            })
            ->when($request->city, function ($query, $city) {
                return $query->join('user_addresses', 'users.id', '=', 'user_addresses.user_id')
                    ->where('user_addresses.city', 'LIKE', '%' . $city . '%');
            })
            ->orderBy('users.id')
            ->paginate(10);

        return [
            'users' => $users
        ];
    }

    public function getLogistics()
    {
        $logistics = Acting::withCount(['users' => function ($query) {
            $query->whereHas('user.profile', function ($query) {
                $query->whereNotNull('cpf');
            });
        }])->get();

        return [
            'logistics' => $logistics
        ];
    }

    public function getSpecializeds()
    {
        $specializeds = Acting::withCount(['users' => function ($query) {
            $query->whereHas('user.profile', function ($query) {
                $query->whereNotNull('cnpj');
            });
        }])->get();

        return [
            'specializeds' => $specializeds
        ];
    }
}
