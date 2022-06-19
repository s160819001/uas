
@extends('layout.softui')
@section('content')

<div class="row">
  <!-- cek jika ada session 'status' -->
    @if(session('status'))
      <div class="alert alert-success text-white" role="alert">
        <strong>{{session('status')}}</strong>
      </div>
    @endif
    <!-- cek jika ada session 'error' -->
    @if(session('error'))
      <div class="alert alert-danger text-white" role="alert">
        <strong>{{session('error')}}</strong>
      </div>
    @endif
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
          <h3 class="float-start">Data Kategori Obat</h3>
          <a class="btn btn-outline-primary btn-sm mb-0 me-3 float-end" data-bs-toggle="modal" data-bs-target="#createCategoryModal">+ Tambah Kategori Obat</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <!-- tabel berisi data kategori obat -->
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kategori</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- $result berasal dari data 'result' yang dikirim bersama ketika view ini dibuka -->
                    @foreach($result as $d)
                    <tr>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{$d->id}}</p>
                      </td>
                      <td class="align-middle">
                        <p id="td*category_name*{{$d->id}}" class="editable text-xs font-weight-bold mb-0">{{$d->category_name}}</p>
                      </td>
                      <td class="align-middle">
                        <!-- ketika diklik akan memanggil modalEdit dan jquery function geteditform dengan parameter id dari kategori yang diklik -->
                        <a href="#modalEdit" class="btn btn-link text-dark px-3 mb-0"  data-toggle="tooltip" data-bs-toggle="modal" onclick="getEditForm({{$d->id}})"><i class="fas fa-pencil-alt text-dark me-2"></i>Edit</a>
                      </td>
                      <td class="align-middle">
                        <!-- form untuk melakukan hapus kategori dengan uri categories/id-nya dan method DELETE==action destroy masuk routing categories.destroy-->
                        <form method="POST" action="{{url('categories/'.$d->id)}}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="tooltip" onclick="if(!confirm('Apakah anda yakin ingin menghapus &quot;{{$d->category_name}}&quot; dari data kategori obat?'))return false;"><i class="far fa-trash-alt me-2 text-danger" aria-hidden="true"></i>DELETE</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
      </div>
    </div>
  </div>


  <!-- bagian awal modal dari createCategoryModal -->
  <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Obat</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- form dengan action route ke categories.store -->
            <form method="POST" action="{{route('categories.store')}}">
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Nama Kategori</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan Kategori obat" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn bg-gradient-primary">+ Tambah Kategori</button>
              </div>
            </form>
            </div>
      </div>
    </div>
  </div>
  <!-- bagian akhir modal createCategoryModal -->
  
  <!-- bagian awal modal dari modalEdit -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Obat</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="modal-body">
          </div>
      </div>
    </div>
  </div>
  <!-- bagian akhir dari modalEdit -->
</div>

      

    @section('javascript')
    <script>
      //script untuk ubah active button pada nav
       document.getElementById("nav_data_obat").classList.remove("active");
       document.getElementById("nav_data_kategori_obat").classList.add("active");
       document.getElementById("nav_data_pembeli").classList.remove("active");
       document.getElementById("nav_best_selling_report").classList.remove("active");
       document.getElementById("nav_top_spender_report").classList.remove("active");

       //fungsi inline edit
       $('.editable').editable({
          closeOnEnter:true,
          callback:function(data){
            if(data.content){
              var s_id=data.$el[0].id;
              var id=s_id.split('*')[2]
              var fname=s_id.split('*')[1]

              $.ajax({
                type:'POST',
                url:'{{route("categories.saveDataField")}}',
                data:{'_token':'<?php echo csrf_token() ?>','id':id,'fname':fname,'value':data.content},
                success:function(data){
                  alert(data.msg);
                }
              });
            }
          }
        });

        // fungsi geteditform masuk ke routing categories.getEditForm dengan method post dengan data id dari kategori obat yang diklik atau mau diedit
        function getEditForm(id){
          $.ajax({
            type:'POST',
            url:'{{route("categories.getEditForm")}}',
            data:{'_token':'<?php echo csrf_token() ?>','id':id},
            success:function(data){
              $('#modal-body').html(data.msg);
            }
          });
        }
    </script>
    @endsection
    

@endsection
