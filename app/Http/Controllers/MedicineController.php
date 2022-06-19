<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use App\Transaction;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin-permission');
        $result=Medicine::all();
        $category=Category::all();
        // $transaction=Transaction::all();
        return view('medicine.index', compact('result','category'));
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
        $data=new Medicine();

        $file=$request->file('image');
        $imgFolder='images';
        $imgFile=time()."_".$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        $data->image=$imgFile;

        $data->generic_name=$request->get('name');
        $data->description=$request->get('desc');
        $data->form=$request->get('form');
        $data->restriction_formula=$request->get('dose');
        $data->faskes_tk1=$request->get('checkFaskes1');
        $data->faskes_tk2=$request->get('checkFaskes2');
        $data->faskes_tk3=$request->get('checkFaskes3');
        $data->category_id=$request->get('kat');
        $data->price=$request->get('price');
        $data->save();
        return redirect()->route('medicines.index')->with('status','Data obat '.$request->get('name').' '.$request->get('form').' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $data=$medicine;
        $category=Category::all();
        return view('medicine.edit', compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        if($request->file('image')){

            $file=$request->file('image');
            $imgFolder='images';
            $imgFile=time()."_".$file->getClientOriginalName();
            $file->move($imgFolder,$imgFile);
            $medicine->image=$imgFile;
        }

        $medicine->generic_name=$request->get('name');
        $medicine->description=$request->get('desc');
        $medicine->form=$request->get('form');
        $medicine->restriction_formula=$request->get('dose');
        $medicine->faskes_tk1=$request->get('checkFaskes1');
        $medicine->faskes_tk2=$request->get('checkFaskes2');
        $medicine->faskes_tk3=$request->get('checkFaskes3');
        $medicine->category_id=$request->get('kat');
        $medicine->price=$request->get('price');
        $medicine->save();
        return redirect()->route('medicines.index')->with('status','Data obat "'.$request->get('name').' '.$request->get('form').'" berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        // $this->authorize('delete-permission');
        try{
            $medicine->delete();
            return redirect()->route('medicines.index')->with('status','Data obat berhasil dihapus');
        }catch(\PDOException $e){
            $msg="Data obat gagal dihapus. Data obat yang pernah dibeli, tidak dapat dihapus.";
            return redirect()->route('medicines.index')->with('error',$msg);
        }
    }

    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data =Medicine::find($id);
        $category =Category::all();
        return response()->json(array(
            'status'=>'OK','msg'=>view('medicine.edit',compact('data','category'))->render()
        ),200);
    }

    public function saveDataField(Request $request){
        $id=$request->get('id');
        $fname=$request->get('fname');
        $value=$request->get('value');

        $medicine =Medicine::find($id);
        $medicine->$fname=$value;
        $medicine->save();
        return response()->json(array(
            'status'=>'ok','msg'=>'Data obat berhasil diubah.'
        ),200);
    }

    public function front_index(){

        $medicines=Medicine::all();
        return view('frontend.product',compact('medicines'));
    }

    public function addToCart($id){
        $this->authorize('member-permission');
        $m=Medicine::find($id);
        $cart=session()->get('cart');
        if(!isset($cart[$id])){
            $cart[$id]=[
                "name"=>$m->generic_name." (".$m->form.")", 
                "qty"=>1,
                "price"=>$m->price,
                "img"=>$m->image
            ];
        }else{
            $cart[$id]['qty']++;
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success',$cart[$id]["name"].' berhasil ditambahkan pada keranjang.');
    }

    public function checkout(){
        $this->authorize('member-permission');
        $cart=session()->get('cart');
        if($cart==null){
            return redirect()->route('medicines.front_index');
        }else
            return view('frontend.checkout');
    }

    public function qtychanges(Request $request){
        $id=$request->get('id');
        $qty=$request->get('qty');

        $cart=session()->get('cart');
        $cart[$id]['qty']=$qty;
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Jumlah '.$cart[$id]["name"].' berhasil diubah pada keranjang.');
    }

    public function deleteitem(Request $request){
        $id=$request->get('id');
        $cart=session()->get('cart');
        unset($cart[$id]);
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Berhasil menghapus item pada keranjang.');
    }
}
