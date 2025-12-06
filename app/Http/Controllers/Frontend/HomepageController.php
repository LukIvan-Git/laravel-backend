<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', 'homepage')->first();

        if(!$page) {
            abort(404);
        }

        \Log::debug($page->translated_data);
        return view('homepage',[
            'page'=> $page
        ]);
    }
}
