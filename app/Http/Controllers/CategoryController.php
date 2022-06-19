<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //routing dari categories.index masuk sini
        //authorize user sebagai admin
        $this->authorize('admin-permission');
        //ambil data dari model category dimasukkan ke var $result
        $result = Category::all();
        //tampilkan view dari folder category file index dengan data $result
        return view('category.index',compact('result'));
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
        //routing dari categories.store masuk sini
        //buat model baru dari category dan var $data untuk menampung
        $data=new Category();
        //var $data key category_name diisikan value dari $request dengan key 'name'
        $data->category_name=$request->get('name');
        //save model pada $data
        $data->save();
        //arahkan kembali ke categories.index dengan session 'status'
        return redirect()->route('categories.index')->with('status','Data kategori obat '.$request->get('name').' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        // $data=$category;
        // return view('category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //routing dari categories.update termasuk uri categories/id-nya dengan method put masuk sini
        // $category berisikan data category dengan id yang didapatkan dari routing/uri lalu men-set key category_name dengan $request yang didapat dari form edit
        $category->category_name=$request->get('name');
        //simpan model categorynya
        $category->save();
        //kembalikan ke route categories.index dengan session 'status'
        return redirect()->route('categories.index')->with('status','Data kategori obat "'.$request->get('name').'" berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //routing dari categories.destroy termasuk uri categories/id-nya dengan method DELETE masuk sini
        //$category isinya data category dari id yang sama dengan uri
        //trycatch untuk exception dari foreignkeycheck ketika menghapus model category
        try{
            //hapus model category dengan id dari uri
            $category->delete();
            //kembalikan ke categories.index dengan session 'status'
            return redirect()->route('categories.index')->with('status','Data kategori obat berhasil dihapus');
        }catch(\PDOException $e){
            $msg="Data kategori obat gagal dihapus. Untuk menghapusnya, hapus data obat yang berkaitan dengan kategori ini lebih dulu.";
            //kembalikan ke categories.index dengan session 'error'
            return redirect()->route('categories.index')->with('error',$msg);
        }
    }

    public function getEditForm(Request $request){
        //routing dari categories.getEditForm masuk sini dengan membawa data id pada parameter($request)
        $id=$request->get('id');
        //buat variabel data untuk menampung data category yang diambil dari model dengan id dari param
        $data =Category::find($id);
        //kirim respon dengan merender view dari folder category file edit dengan data category
        return response()->json(array(
            'status'=>'OK','msg'=>view('category.edit',compact('data'))->render()
        ),200);
    }

    public function saveDataField(Request $request){
        //routing dari categories.saveDataField masuk sini dengan membawa data id,name(key-nya), dan value
        //implementasi dari inline edit
        $id=$request->get('id');
        $fname=$request->get('fname');
        $value=$request->get('value');

        //mirip update
        $category =Category::find($id);
        $category->$fname=$value;
        $category->save();
        return response()->json(array(
            'status'=>'ok','msg'=>'Data kategori obat berhasil diubah.'
        ),200);
    }
}
