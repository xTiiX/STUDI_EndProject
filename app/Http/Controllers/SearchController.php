<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use DB;

class SearchController extends Controller
{

    public function index()
    {
        return view('tuto-search', ['partners' => Partner::withTrashed()->get()]);
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            $products = [];
            $products = DB::table('users')->where('first_name','LIKE','%'.$request->search.'%')->get();

            if($products) {
                return Response($products);
            }
        }
    }

    public function workingSearch(Request $request)
    {
        if($request->ajax())
        {
            $partners = [];
            $partners = Partner::withTrashed()->where('short_desc','LIKE','%'.$request->search."%")->get();

            if ($partners)
                return $partners;
        }
    }

    public function searchPartners(Request $req)
    {
        if ($req->ajax()) {
            // Adding reviews and total review
            $partners = Partner::withTrashed()->where('short_desc', 'LIKE', '%'.$req->search.'%')->get();

            $output = '';

            foreach ($partners as $partner) {
                if ($partner->trashed())
                    $attributes = "bg-red-400 overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3";
                else
                    $attributes = "bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3";
                return view("components.partner-board-part",
                ["partner" => $partner, "attributes" => $attributes]);
                $output .= view("components.partner-board-part",
                    ["partner" => $partner, "attributes" => $attributes])
                    ->render();
            }


            if ($partners)
                return $output;
        }
    }
}
