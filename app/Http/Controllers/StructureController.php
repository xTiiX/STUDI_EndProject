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

class StructureController extends Controller
{
    /**
     * Display the Structures's view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partners = Partner::withTrashed()->get();
        $users = User::withTrashed()->get();
        $partner = Partner::withTrashed()->where('user_id', auth()->user()->id)->first();

        if (auth()->user()->access_level === 0)
            $structures = Structure::withTrashed()->get();
        else if (auth()->user()->access_level === 1)
            $structures = Structure::withTrashed()->where('partner_id', $partner->id)->get();
        else
            $structures = Structure::withTrashed()->where('id', UserStructure::where('user_id', auth()->user()->id)->first()->user_id)->get();

        return view('structure.dashboard',
            [
                'structures' => $structures,
                'partners' => $partners,
                'users' => $users,
                'partner' => $partner
            ]);
    }

    /**
     * Display the Partner's Structures view
     *
     * @return \Illuminate\View\View
     */
    public function indexPartner(int $partner_id)
    {
        $services = Service::all();
        $selected = PartnerService::where('partner_id', $partner_id)->get();

        $selected_ids = [];
        foreach ($selected as $link)
            if (!in_array($link->service_id, $selected_ids))
                $selected_ids[] = $link->service_id;

        // is_checked for Services in PartnerService table
        for ($i=0; $i < count($services); $i++)
            if (in_array($services[$i]->id, $selected_ids))
                $services[$i]->is_checked = true;
            else
                $services[$i]->is_checked = false;

        return view('structure.partner-dashboard',
            [
                'structures' => Structure::withTrashed()->get(),
                'partners' => Partner::withTrashed()->get(),
                'users' => User::withTrashed()->get(),
                'services' => $services,
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
        $structure = Structure::withTrashed()->where('id', $structure_id)->first();
        $partner_links = PartnerService::where('partner_id', $structure->partner_id)->get();
        $selected_links = StructureService::where('structure_id', $structure_id)->get();

        $services_ids = [];
        foreach ($partner_links as $link)
            if (!in_array($link->service_id, $services_ids))
                $services_ids[] = $link->service_id;

        $selected_ids = [];
        foreach ($selected_links as $link)
            if (!in_array($link->service_id, $selected_ids))
                $selected_ids[] = $link->service_id;

        $services = [];
        foreach ($services_ids as $service_id)
            $services[] = Service::where('id', $service_id)->first();

        // is_checked for PartnerService in StructureService table
        for ($i=0; $i < count($services); $i++)
            if (in_array($services[$i]->id, $selected_ids))
                $services[$i]->is_checked = true;
            else
                $services[$i]->is_checked = false;

        return view('structure.view',
            [
                'structures' => Structure::withTrashed()->get(),
                'partners' => Partner::withTrashed()->get(),
                'users' => User::withTrashed()->get(),
                'services' => $services,
                'structure' => $structure
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
     * Create a new Structure, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function createLock(int $partner_id)
    {
        $partners[] = Partner::where('id', $partner_id)->first();
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
