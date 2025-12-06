<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class MenuItem
{

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $pages = Page::all();
        $items = [];
        foreach ($pages as $page) {
            $items[] = [
                'title' => $page->title,
                'route' => $page->route,
            ];
        }   

        View::share([
            'menus' => $items,
        ]);
        return $next($request);
    }
}
