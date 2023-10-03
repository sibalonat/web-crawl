<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use PHPHtmlParser\Dom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
    * basic check if you can visi the page.
    */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $response = Http::get('https://blog.codecourse.com');

        $dom = new Dom;

        $dom->loadStr($response->body());


        $titlelinkcollection = $dom->find('.tracking-tight');


        $titleandlink = collect($titlelinkcollection);

        $extracted = $titleandlink->map(function ($item) {
            $href = $item->getTag()->getAttribute('href')->getValue();
            return [
                'href' => 'https://blog.codecourse.com/'.$href,
            ];
        });


        $htmlcontent = collect([]);


        foreach ($extracted as $html) {
            $response = Http::get($html['href']);

            $innerdom = new Dom;

            $innerdom->loadStr($response->body());

            $innerHtml = $innerdom->innerHtml;

            $htmlcontent->push($innerHtml);

        }


        $htmlcontent->each(function($item, $index) {
            Storage::disk('public')->put('codecourse'.$index.'.html', $item);
        });




        return Inertia::render('Dashboard');
    }

}
