<?php

namespace App\Http\Controllers;

use App\Services\BaytServiceProvider;
use SimpleXMLElement;

class JobsController extends Controller
{
    /**
     * @var App\Providers\BaytServiceProvider
     */
    private $baytServiceProvider;

    public function __construct(BaytServiceProvider $baytServiceProvider)
    {
        $this->baytServiceProvider = $baytServiceProvider;
    }

    public function index()
    {
        // pass the data to a view and display it on the web page
        $data = $this->baytServiceProvider->requestData(config('xmlPaths.rotana_careers'));

        return view('jobs.index', ['data' => $data]);
    }

    public function show($id)
    {
        $item = $this->baytServiceProvider->getItemById($id);
        return view('jobs.landing', ['data' => $item]);

    }
}
