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
            $partners = Partner::withTrashed()->where('short_desc', 'LIKE', '%'.$req->search.'%')->get();
            if ($req->search == '')
                $partners = Partner::withTrashed()->get();

            $output = '';

            foreach ($partners as $partner) {
                if (!$partner->trashed())
                    $output .= '<div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3">';
                else
                    $output .= '<div class="bg-red-400 overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3">';

                $output .= '<div class="p-6">
                <div class="flex">
                    <div class="mr-4 mt-2 h-10 w-10">
                        <a href='. route("partners.structures.index_partner", ["partner_id", $partner->id]) . '>
                            <img src=' . $partner->logo_url . ' alt="" class=" bg-gray-500 sm:shadow-sm rounded-full p-1 object-scale-down">
                        </a>
                    </div>
                    <div class="flex grow">
                        <div>
                            <p class="text-lg underline">' . $partner->short_desc . '</p><p class="text-xs">Relier à : ' . $partner->linkUser()->first()->first_name . ' ' . $partner->linkUser()->first()->last_name . '</p>
                        </div>
                        <div class="grow"></div>';
                        if (auth()->user()->access_level === 0) {
                            if ($partner->trashed()) {
                                $output .= '<div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                                <form action="' . route("partners.restore", $partner->id) . '" method="post">
                                    <input type="hidden" name="_token" value='. csrf_token() .'>
                                    <button type="submit" class="text-white sm:shadow-sm"> Acti</button>
                                </form>
                            </div>';
                            }
                            else {
                                $output .= '<div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 text-center mt-2">
                                    <a href="' . route("partners.show", $partner->id) . '" class="text-white sm:shadow-sm">
                                        Edit
                                    </a>
                                </div>
                                <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                                    <form action="' . route("partners.delete", $partner->id) . '" method="post">
                                        <input type="hidden" name="_token" value='. csrf_token() .'>
                                        <button type="submit" class="text-white sm:shadow-sm"> Désa</button>
                                    </form>
                                </div>';
                            }
                        }
                    $output .= '</div></div></div></div>';
            }

            if ($partners)
                return $output;
        }
    }
}
