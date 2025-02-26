<?php

namespace App\Http\Controllers;

use App\Services\FeaturedThreadService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $featuredThreadService;

    public function __construct(FeaturedThreadService $featuredThreadService)
    {
        $this->featuredThreadService = $featuredThreadService;
    }

    public function index()
    {

        $featuredThreads = $this->featuredThreadService->getFeaturedThreads([ 'limit' => 5 ]);

        return view('index', ['featuredThreads' => $featuredThreads['data']]);
    }
}
