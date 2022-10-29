<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;
use App\Models\Partner;
use App\Models\User;
use App\Models\Service;
use App\Models\PartnerService;
use App\Models\StructureService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\RegisterMail;

class PartnerController extends Controller
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
        return view('partner.dashboard', ['partners' => $partners, 'users' => $users, 'structures' => $structures]);
    }

    /**
     * Create a new Partner, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('partner/create-partner');
    }

    /**
     * Store a new Partner
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $req)
    {
        $password = Str::random(20);
        $req['password'] = Hash::make($password);
	$req['access_level'] = 1;
	$validated = $req->validate([
            'first_name' => 'required | string',
            'last_name' => 'required | string',
            'email' => 'required | unique:users',
            'logo_url' => 'required',
            'short_desc' => 'required | string',
            'full_desc' => 'nullable',
            'dpo' => 'nullable',
            'technical_contact' => 'nullable',
            'commercial_contact' => 'nullable',
            'user_id' => 'nullable',
            'password' => 'required',
	    'access_level' => 'nullable',
	    ]);

        $user = User::create($validated);
        $validated['user_id'] = $user->id;

        $partner = Partner::create($validated);

        // Send Email with password
        //return dd($password, $user->email);

        $mailData = [
            'title' => 'Bienvenue chez Loockers ! - Création de compte',
            'email' => $user->email,
            'password' => $password
        ];

        Mail::to($user->email)->send(new RegisterMail($mailData));

        return redirect(route('partners.index')); // SESSION TO SAY ITS DONE ! :D
    }

    /**
     * Show a Partner to modify
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('partner.show-partner', ['partner' => Partner::where('id', $id)->first()]);
    }

    /**
     * Store modification of the Partner
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $req)
    {
        $validated = $req->validate([
            'logo_url' => 'required',
            'short_desc' => 'required | string',
            'full_desc' => 'nullable',
            'dpo' => 'nullable',
            'technical_contact' => 'nullable',
            'commercial_contact' => 'nullable',
        ]);

        $partner = Partner::where('id', $req->id)->first();

        $partner->short_desc = $req->short_desc;
        $partner->full_desc = $req->full_desc;
        $partner->logo_url = $req->logo_url;
        $partner->dpo = $req->dpo;
        $partner->technical_contact = $req->technical_contact;
        $partner->commercial_contact = $req->commercial_contact;

        $partner->save();

        return redirect(route('partners.index'));
    }

    /**
     * Delete a Partner
     *
     * @return \Illuminate\View\View
     */
    public function delete(int $id)
    {
        $partner = Partner::where('id', $id)->first();
        $partner->linkUser()->first()->delete();
        $partner->delete();
        return redirect()->back();
    }

    /**
     * Display the Partners's view
     *
     * @return \Illuminate\View\View
     */
    public function restore(int $id)
    {
        $partner = Partner::withTrashed()->where('id', $id)->first();
        $partner->linkUser()->first()->restore();
        $partner->restore();
        return redirect()->back();
    }
}
