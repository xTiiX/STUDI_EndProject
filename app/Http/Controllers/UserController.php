<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;
use App\Models\Partner;
use App\Models\User;
use App\Models\UserStructure;
use App\Models\Service;
use App\Models\PartnerService;
use App\Models\StructureService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\RegisterMail;

class UserController extends Controller
{
    /**
     * Display the Partners's view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partners = Partner::withTrashed()->get();
        $structures = Structure::withTrashed()->get();
        $users = User::withTrashed()->get();
        return view('user.dashboard', ['partners' => $partners, 'users' => $users, 'structures' => $structures]);
    }

    /**
     * Create a new User, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.create-user', ['structures' => Structure::withTrashed()->get()]);
    }

    /**
     * Store a new User
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $req)
    {
        $password = Str::random(20);
        $req['password'] = Hash::make($password);
        $req['access_level'] = $req->access_level;
        $validated = $req->validate([
            'first_name' => 'required | string',
            'last_name' => 'required | string',
            'email' => 'required | unique:users',
            'password' => 'required',
            'access_level' => 'nullable',
        ]);

        $user = User::create($validated);

        // Link to structure if needed
        if ($req->access_level !== 0) {
            $link = new UserStructure;
            $link->user_id = $user->id;
            $link->structure_id = $req->structure_id;
            $link->save();
        }

        $mailData = [
            'title' => 'Bienvenue chez Loockers ! - Création de compte',
            'email' => $user->email,
            'password' => $password
        ];

        Mail::to($user->email)->send(new RegisterMail($mailData));

        return redirect(route('users.index')); // SESSION TO SAY ITS DONE ! :D
    }

    /**
     * Show a User to modify
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        if (UserStructure::where('user_id', $id)->first() !== NULL)
            $structure_id = Structure::where('id', UserStructure::where('user_id', $id)->first()->structure_id)->first()->id;
        else
            $structure_id = 0;
        return view('user.show-user', [
            'user' => User::where('id', $id)->first(),
            'structures' => Structure::withTrashed()->get(),
            'structure_id' => $structure_id,
        ]);
    }

    /**
     * Store modification of the User
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $req)
    {
        $validated = $req->validate([
            'first_name' => 'required | string',
            'last_name' => 'required | string',
            'email' => 'required | unique:users',
            'access_level' => 'nullable',
        ]);

        $user = User::where('id', $req->id)->first();

        if ($user->email != $req->email) {
            $password = Str::random(20);
            $user->passsword = Hash::make($password);
            $mailData = [
                'title' => 'Bienvenue chez Loockers ! - Création de compte',
                'email' => $req->email,
                'password' => $password
            ];
        }

        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->access_level = $req->access_level;

        $user->save();

        return redirect(route('users.index'));
    }

    /**
     * Delete a User
     *
     * @return \Illuminate\View\View
     */
    public function delete(int $id)
    {
        $user = User::where('id', $id)->first()->delete();
        return redirect()->back();
    }

    /**
     * Display the Partners's view
     *
     * @return \Illuminate\View\View
     */
    public function restore(int $id)
    {
        $user = User::withTrashed()->where('id', $id)->first()->restore();
        return redirect()->back();
    }
}
