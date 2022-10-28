<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;
use App\Models\Partner;
use App\Models\User;

class StructureController extends Controller
{
    /**
     * Display the Structures's view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $structures = Structure::withTrashed()->get();
        $partners = Partner::withTrashed()->get();
        $users = User::withTrashed()->get();
        return view('structure.dashboard', ['structures' => $structures, 'partners' => $partners, 'users' => $users]);
    }

    /**
     * Display the Partner's Structures view
     *
     * @return \Illuminate\View\View
     */
    public function indexPartner(int $partner_id)
    {
        return view('structure.partner-dashboard',
            [
                'structures' => Structure::withTrashed()->get(),
                'partners' => Partner::withTrashed()->get(),
                'users' => User::withTrashed()->get(),
                'structs_partner' => Structure::withTrashed()->where('partner_id', $partner_id)->get(),
                'partner' => Partner::withTrashed()->where('id', $partner_id)->first()
            ]);
    }

    /**
     * Display the Partner's Structures view
     *
     * @return \Illuminate\View\View
     */
    public function indexStructure(int $structure_id)
    {
        return view('structure.view',
            [
                'structures' => Structure::withTrashed()->get(),
                'partners' => Partner::withTrashed()->get(),
                'users' => User::withTrashed()->get(),
                'struct' => Structure::withTrashed()->where('id', $structure_id)->get()
            ]);
    }

    /**
     * Create a new Structure, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $partners = Partner::all();
        return view('structure.create-structure', ['partners' => $partners]);
    }

    /**
     * Store a new Structure
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $req)
    {
        $validated = $req->validate([
                'name' => 'required | string',
                'adress' => 'required | string',
                'phone' => 'required | string',
                'logo_url' => 'required',
                'partner_id' => 'nullable',
        ]);

        $structure = Structure::create($validated);

        return redirect(route('partners.structures.index')); // SESSION TO SAY ITS DONE ! :D
    }

    /**
     * Show a Structure to modify
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('structure.show-structure', ['structure' => Structure::where('id', $id)->first(), 'partners' => Partner::withTrashed()->get()]);
    }

    /**
     * Store modification of the Structure
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required | string',
            'adress' => 'required | string',
            'phone' => 'required | string',
            'logo_url' => 'required',
            'partner_id' => 'nullable',
        ]);

        $structure = Structure::where('id', $req->id)->first();

        $structure->name = $req->name;
        $structure->adress = $req->adress;
        $structure->phone = $req->phone;
        $structure->logo_url = $req->logo_url;

        $structure->save();

        return redirect(route('partners.structures.index'));
    }

    /**
     * Delete a Structure
     *
     * @return \Illuminate\View\View
     */
    public function delete(int $id)
    {
        $structure = Structure::where('id', $id)->first()->delete();
        return redirect()->back();
    }

    /**
     * Display the Structures's view
     *
     * @return \Illuminate\View\View
     */
    public function restore(int $id)
    {
        $structure = Structure::withTrashed()->where('id', $id)->first()->restore();
        return redirect()->back();
    }
}
