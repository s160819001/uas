<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaction;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //routing history masuk sini (dibuat di web.php line 49)
        //authorize user sebagai member
        $this->authorize('member-permission');

        //dapatkan user dan tampung pada var user
        $user = Auth::user();
        //buat var result untuk menampung data transaksi dengan user_id dari transaksi == user yang login ini(auth::user)
        $result = Transaction::where('user_id', $user->id)->get();
        //arahkan ke view folder frontend file history dengan data result
        return view('frontend.history', compact('result'));
    }
}
