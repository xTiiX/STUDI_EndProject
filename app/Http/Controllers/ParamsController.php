<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParamsController extends Controller
{
    public function index()
    {
        return view('parameters', ['user', Auth::user()]);
    }

    public function storeNewPass(Request $req)
    {
        // Debug test
        // return dd($req);

        if ($req->check_password !== $req->new_password)
            return redirect()->back();
        else {
            $user = Auth::user();

            if (!Hash::check($req->last_password, $user->password))
                return redirect()->back();

            $user->forceFill([
                'password' => Hash::make($req->new_password)
            ])->save();

            // Debug test
            // return dd('doooone ~');
            return redirect(route('partners.index'));
        }
    }
}
