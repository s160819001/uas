
@extends('layout.softui')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <h3 class="float-start">Detail Transaksi</h3><br><br>
        <p><h5 class="float-start">Kode Transaksi : <strong>{{$result->id}}</strong></h5></p><br>
        <p><h5 class="float-start">Tanggal Pemesanan : <strong>{{$result->transaction_date}}</h5></p>
        <!-- <a class="btn btn-outline-primary btn-sm mb-0 me-3 float-end" data-bs-toggle="modal" data-bs-target="#createMedicineModal">+ Tambah Obat</a> -->
      </div>
      <div class="card-body px-3 pt-0 pb-3">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:50%">Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:10%">Harga</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:8%">Qty</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:22%">Subtotal</th>
                      <th style="width:10%"></th>
              </tr>
            </thead>
            <tbody>
                    @foreach($medicines as $d)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('images/'.$d->image)}}" class="avatar avatar-xxl me-3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 id="td*generic_name*{{$d->id}}" class="mb-0 text-xl ">{{$d->generic_name}}</h6>
                            <p id="td*form*{{$d->id}}" class="text-lrg text-secondary mb-0 ">{{$d->form}}</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0 ">Rp {{number_format($d->price,0,',','.')}},-</p>
                      </td>
                      <td class="align-middle text-sm-end text-sm">
                         <input type="text" disabled class="form-control text-dark text-center" value="{{$d->pivot->quantity}}">
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0 ">Rp {{number_format($d->pivot->quantity * $d->price,0,',','.')}},-</p>
                      </td>
                      <td></td>
                    </tr>
                    @endforeach
            </tbody>
            <tfoot>
        <tr>
            <td colspan="3" class=" text-center">TOTAL</td>
            <td class=" align-middle font-weight-bold mb-0 text-center"><strong>Rp {{number_format($result->total,0,',','.')}}</strong></td>
        </tr>
        </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>


  @section('javascript')
      <script>
        document.getElementById("nav_data_obat").classList.remove("active");
        document.getElementById("nav_data_kategori_obat").classList.remove("active");
        document.getElementById("nav_data_pembeli").classList.add("active");
        document.getElementById("nav_best_selling_report").classList.remove("active");
        document.getElementById("nav_top_spender_report").classList.remove("active");

        $('.editable').editable({
          closeOnEnter:true,
          callback:function(data){
            if(data.content){
              var s_id=data.$el[0].id;
              var id=s_id.split('*')[2]
              var fname=s_id.split('*')[1]

              $.ajax({
                type:'POST',
                url:'{{route("medicines.saveDataField")}}',
                data:{'_token':'<?php echo csrf_token() ?>','id':id,'fname':fname,'value':data.content},
                success:function(data){
                  alert(data.msg);
                }
              });
            }
          }
        });

        function getEditForm(id){
          $.ajax({
            type:'POST',
            url:'{{route("medicines.getEditForm")}}',
            data:{'_token':'<?php echo csrf_token() ?>','id':id},
            success:function(data){
              $('#modal-body').html(data.msg);
            }
          });
        }
    </script>
  @endsection
@endsection