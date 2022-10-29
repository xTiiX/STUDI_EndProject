<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partner;
use App\Models\Structure;
use App\Models\Service;
use App\Models\PartnerService;
use App\Models\StructureService;

class ServiceController extends Controller
{
    /**
     * Display the Services's view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $structures = Structure::withTrashed()->get();
        $partners = Partner::withTrashed()->get();
        $users = User::withTrashed()->get();
        $services = Service::withTrashed()->get();
        return view('service.dashboard',
            [
                'structures' => $structures,
                'partners' => $partners,
                'users' => $users,
                'services' => $services,
            ]);
    }

    /**
     * Create a new Service, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('service.create-service');
    }

    /**
     * Store a new Service
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $req)
    {
        $validated = $req->validate([
                'name' => 'required | string',
        ]);

        $service = Service::create($validated);

        return redirect(route('services.index')); // SESSION TO SAY ITS DONE ! :D
    }

    /**
     * Show a Service to modify
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('service.show-service', ['service' => Service::where('id', $id)->first()]);
    }

    /**
     * Store modification of the Service
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required | string',
        ]);

        $service = Service::where('id', $req->id)->first();

        $service->name = $req->name;

        $service->save();

        return redirect(route('services.index'));
    }

    /**
     * Delete a Service
     *
     * @return \Illuminate\View\View
     */
    public function delete(int $id)
    {
        $service = Service::where('id', $id)->first()->delete();
        return redirect()->back();
    }

    /**
     * Display the Services's view
     *
     * @return \Illuminate\View\View
     */
    public function restore(int $id)
    {
        $service = Service::withTrashed()->where('id', $id)->first()->restore();
        return redirect()->back();
    }
}
