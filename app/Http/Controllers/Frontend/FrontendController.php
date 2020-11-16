<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $body_class = '';

        // return view('frontend.index', compact('body_class'));
        return redirect("admin");
    }

    /**
     * Privacy Policy Page
     *
     * @return \Illuminate\Http\Response
     */
    public function privecy()
    {
        $body_class = '';

        return view('frontend.privecy', compact('body_class'));
    }

    /**
     * Terms & Conditions Page
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $body_class = '';

        return view('frontend.terms', compact('body_class'));
    }

    public function imagecarousel()
    {
        $module_name = Carousel::orderBy('position', 'asc')->get();
        return $module_name;
    }
}
