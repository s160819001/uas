
@extends('layout.softui')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h3 class="float-start">Laporan Pembeli Terbanyak</h3>
        <!-- <a class="btn btn-outline-primary btn-sm mb-0 me-3 float-end" data-bs-toggle="modal" data-bs-target="#createMedicineModal">+ Tambah Obat</a> -->
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center px-3">
            <thead>
              <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Transaksi</th>
              </tr>
            </thead>
            <tbody>
                    @foreach($result as $d)
                    <tr>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{$d->user_id}}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xl ">{{$d->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <p  class="text-xs font-weight-bold mb-0 ">{{$d->email}}</p>
                      </td>
                      <td class="align-middle text-sm-end text-sm">
                        <p class="text-lr font-weight-bold mb-0">Rp {{number_format($d->totaleachuser,0,',','.')}},-</p>
                      </td>
                    </tr>
                    @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>


  @section('javascript')
      <script>
        document.getElementById("nav_data_obat").classList.remove("active");
        document.getElementById("nav_data_kategori_obat").classList.remove("active");
        document.getElementById("nav_data_pembeli").classList.remove("active");
        document.getElementById("nav_best_selling_report").classList.remove("active");
        document.getElementById("nav_top_spender_report").classList.add("active");

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