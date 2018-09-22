<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\orders;
use \App\Models\shippers;
use \App\Models\customers;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pendingorders = orders::where('status', 'Pending')->get();
        $completedorders = orders::where('status', 'Delivered')->get();
        $shippers =shippers::all()->count();
        $customers =customers::all()->count();
        $recentOrders = orders::orderBy('created_at', 'desc')->take(5)->get();
        $recentcustomers = \App\Models\customers::orderBy('created_at', 'desc')->take(5)->get();
        return view('home')->with('Pendingorders', $Pendingorders->count())->with('completedorders', $completedorders->count())->with('shippers', $shippers)->with('customers', $customers)->with('recentOrders', $recentOrders)->with('recentcustomers', $recentcustomers);
        
    }
}
