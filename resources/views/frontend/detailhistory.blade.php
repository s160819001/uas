@extends('layouts.frontend')

@section('title', 'Detail Riwayat Transaksi')

@section('content')
<div class="card mb-4">
    <div class="card-header pb-0">
        <h5>Kode Transaksi : <strong>{{$result->id}}</strong></h5><br>
        <h5>Tanggal Pemesanan : <strong>{{$result->transaction_date}}</strong></h5>
    </div>
    <div class="card-body  px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
    <table id="cart" class="table align-items-center justify-content-center mb-0">
        <thead>
        <tr>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder" style="width:50%">Barang</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder" style="width:10%">Harga</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder" style="width:8%">Qty</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder" style="width:22%" class="text-center">Subtotal</th>
            <th  style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($medicines as $d)
        <tr>
            <td data-th="Product">
                <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('images/'.$d->image)}}" class="avatar avatar-xxl me-3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xl ">{{$d->generic_name}}</h6>
                            <p class="mb-0 text-lg ">{{$d->form}}</p>
                          </div>
                        </div>
            </td>
            <td data-th="Price" class="text-right">Rp {{number_format($d->price,0,',','.')}}</td>
            <td data-th="Quantity">
                <input type="text" disabled class="form-control text-center" value="{{$d->pivot->quantity}}">
            </td>
            <td data-th="Subtotal" class="text-center">Rp {{number_format($d->pivot->quantity * $d->price,0,',','.')}}</td>
            <td class="actions" data-th="">
                <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                <!-- <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button> -->
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <!-- <td><a href="{{ url('/') }}" class="btn btn-info"><i class="fa fa-angle-left"></i> Kembali Belanja</a></td> -->
            <td colspan="3" class="hidden-xs text-right">TOTAL</td>
            <td class="hidden-xs text-center"><strong>Rp {{number_format($result->total,0,',','.')}}</strong></td>
            <!-- <td><a href="{{ url('/submit') }}" class="btn btn-success"><i class="fa fa-send"> Pesan Sekarang</a></td> -->
        </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
@endsection

