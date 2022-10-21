<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use DB;

class SearchController extends Controller
{

    public function index()
    {
        return view('tuto-search', ['users' => DB::table('users')->get(), 'products' => 'qzd']);
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

    public function searchPartners(Request $req)
    {
        if ($req->ajax()) {
            // Adding reviews and total review
            $partners = Partner::where('short_desc', 'LIKE', '%'.$req->search.'%')->get();

            $output = '';

            foreach ($partners as $partner) {
                if ($partner->trashed())
                    $attributes = "bg-red-400 overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3";
                else
                    $attributes = "bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3";

                $output .= view("components.partner-board-part",
                    ["partner" => $partner, "attributes" => $attributes])
                    ->render();
            }


            if ($partners)
                return $output;
        }
    }
}
