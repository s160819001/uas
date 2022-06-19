<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use App\Medicine;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('admin-permission');
        $result = Transaction::all();
        return view('transaction.index',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=Auth::user();
        $result = Transaction::find($id);
        //logika otentikasi sendiri
        if($result!=null && $result->user_id==$user->id || $user->sebagai=='admin'){
            $medicines=$result->medicines;
            if($user->sebagai=='member')
            return view('frontend.detailhistory', compact('result','medicines'));
            if($user->sebagai=='admin' || $user->sebagai=='superadmin')
            return view('transaction.detail', compact('result','medicines'));
        }else {
            $msg="Data transaksi tersebut tidak ada atau bukan milik anda.";
            return redirect()->route('history')->with('error',$msg);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function submit(){
        $this->authorize('member-permission');

        $cart=session()->get('cart');
        $user=Auth::user();
        $t= new Transaction;
        $t->user_id=$user->id;
        $t->save();

        $total=$t->insertMedicines($cart,$user);
        $t->total=$total;
        $t->save();

        session()->forget('cart');
        $msg="Pesanan anda telah diterima. Terima kasih telah berbelanja di Apotik U.";
        return redirect('/')->with('status',$msg);
    }

    public function terlaris(){

        $this->authorize('admin-permission');
        $result=DB::table("medicine_transaction")
        ->join("medicines", function($join){
            $join->on("medicine_transaction.medicine_id", "=", "medicines.id");
        })
        ->select("medicine_id", \DB::raw("sum(quantity) as totaleachmedicine"), "medicines.generic_name", "medicines.form", "medicines.price", "medicines.image")
        ->groupBy("medicine_id", "medicines.generic_name", "medicines.form", "medicines.price", "medicines.image")
        ->orderBy("totaleachmedicine","desc")
        ->limit(5)
        ->get();

        return view('report.terlaris',compact('result'));
    }

    public function topspender(){

        $this->authorize('admin-permission');
        $result=DB::table("transactions")
        ->join("users", function($join){
            $join->on("transactions.user_id", "=", "users.id");
        })
        ->select("user_id", \DB::raw("sum(total) as totaleachuser"), "users.name", "users.email")
        ->limit(3)
        ->orderBy("totaleachuser","desc")
        ->groupBy("user_id", "users.name", "users.email")
        ->get();

        return view('report.topspender',compact('result'));
    }
}
