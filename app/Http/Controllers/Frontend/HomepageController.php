<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TechStackItem;
class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', 'homepage')->first();

        if(!$page) {
            abort(404);
        }

        $items = TechStackItem::all();
        
        return view('homepage',[
            'page'=> $page,
            'tech_items' => $items
        ]);
    }
}
