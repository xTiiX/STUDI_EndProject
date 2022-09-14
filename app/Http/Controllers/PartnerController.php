<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\User;

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
        $users = User::all();
        // return $partners;
        return view('dashboard', ['partners' => $partners, 'users' => $users]);
    }

    /**
     * Create a new Partner, ready to be store
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        return view('partner/create-partner', ['users' => $users]);
    }

    /**
     * Store a new Partner
     *
     * @return \Illuminate\View\View
     */
    public function store()
    {
        $partner = [];
    }

    /**
     * Show a Partner to modify
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {

    }

    /**
     * Store modification of the Partner
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {

    }

    /**
     * Delete a Partner
     *
     * @return \Illuminate\View\View
     */
    public function delete()
    {

    }

    /**
     * Display the Partners's view
     *
     * @return \Illuminate\View\View
     */
    public function restore()
    {

    }
}
