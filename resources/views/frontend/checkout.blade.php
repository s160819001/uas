@extends('layouts.frontend')

@section('title', 'Keranjang Belanja')

@section('content')
@if(session('success'))
    <div class="alert alert-success text-white" role="alert">
        <strong>{{session('success')}}</strong>
    </div>
 @endif
<div class="card mb-4">
    <div class="card-header pb-0"><h4>Keranjang Belanja</h4></div>
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
        <?php $total=0; $jumlah=0;?>

@if(session('cart'))
@foreach(session('cart') as $id=>$details)
    <?php
        $jumlah+=$details['qty'];
        $total+=$details['qty']*$details['price'];
    ?>
        
        <tr>
            <td data-th="Product">
                <!-- <div class="row">
                    <div class="col-sm-3 hidden-xs"><img height='50px' src="{{asset('images/'.$details['img'])}}" alt="..." class="img-responsive"/></div>
                    <div class="col-sm-9">
                        <h4 class="nomargin">{{$details['name']}}</h4>
                    </div>
                </div> -->
                <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('images/'.$details['img'])}}" class="avatar avatar-xxl me-3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xl editable">{{$details['name']}}</h6>
                          </div>
                        </div>
            </td>
            <td data-th="Price" class="text-right">Rp {{number_format($details['price'],0,',','.')}}</td>
            <td data-th="Quantity">
                <input id="qty_{{$id}}" onchange="reload(this.id,this.value)" type="number" class="form-control text-center" value="{{$details['qty']}}">
            </td>
            <td data-th="Subtotal" class="text-center">Rp {{number_format($details['qty']*$details['price'],0,',','.')}}</td>
            <td class="actions" data-th="">
                <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                <button id="delete_{{$id}}" onclick="remove(this.id)" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-info"><i class="fa fa-angle-left"></i> Kembali Belanja</a></td>
            <td colspan="2" class="hidden-xs text-right">Total</td>
            <td class="hidden-xs text-center"><strong>Rp {{number_format($total,0,',','.')}}</strong></td>
            <td><a href="<?php if($total!=0) echo "/submit" ?>" class="btn btn-success"><i class="fa fa-send"> Pesan Sekarang</a></td>
        </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
@endsection

@section('scripts')
    <script>
        function reload(preid,val){
            var id=preid.split('_')[1]
            $.ajax({
                type:'POST',
                url:'{{route("medicines.qtychanges")}}',
                data:{'_token':'<?php echo csrf_token() ?>','id':id,'qty':val},
                success:function(data){
                  
                }
              });
              location.reload();
        }

        function remove(preid){
            var id=preid.split('_')[1]
            $.ajax({
                type:'POST',
                url:'{{route("medicines.deleteitem")}}',
                data:{'_token':'<?php echo csrf_token() ?>','id':id},
                success:function(data){
                  
                }
              });
              location.reload();
        }
    </script>
@endsection