<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Models\UserFile;
use App\Models\Acting;
use App\Models\UserActing;
use App\Models\UserClipping;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->profile->update([
            'name' => $request->name,
            'representative' => $request->representative,
            'cnpj' => $request->cnpj,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'race' => $request->race,
            'pcd' => $request->pcd,
            'website' => $request->website,
            'film_friendly_network' => $request->film_friendly_network
        ]);

        // $acting = $request->input('acting');
        // dd($acting);
        // dd($request);

        $acting = $request->input('acting');
        $userActing = UserActing::where('user_id', $user->id)->first();
        $userActing->acting_id = $acting;
        $userActing->save();

        return redirect()->back();
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::user();

        $user->address->update([
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'state_registration' => $request->state_registration,
            'municipal_registration' => $request->municipal_registration,
        ]);

        return redirect()->back();
    }

    public function updateFile(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        $fileTypes = ['curriculum', 'proof_of_address', 'rg_front', 'rg_back'];

        foreach ($fileTypes as $fileType) {
            if ($request->hasFile($fileType)) {
                $file = $request->file($fileType);
                $filename = $file->getClientOriginalName();
                $filePath = $file->store("files/{$user->id}/{$fileType}");
                $fileExtension = $file->getClientOriginalExtension();
                $userFile = $user->files()->where('type', $fileType)->first();
                if ($userFile) {
                    Storage::delete($userFile->path);
                    $userFile->update([
                        'name' => $filename,
                        'path' => $filePath,
                        'extension' => $fileExtension
                    ]);
                } else {
                    $user->files()->create([
                        'name' => $filename,
                        'path' => $filePath,
                        'extension' => $fileExtension
                    ]);
                }
            }
        }

        return redirect()->back();
    }

    public function updateClipping(Request $request)
    {
        $user = Auth::user();

        foreach ($request->clips as $clip) {
            if (!empty($clip['value'])) {
                UserClipping::create([
                    'user_id' => $user->id,
                    'clipping' => $clip['value'],
                ]);
            }
        }
    }

    public function deleteClip($id)
    {
        $clip = UserClipping::findOrFail($id);

        $clip->delete();
    }
}
