
@extends('layout.softui')
@section('content')

<div class="row">
  @if(session('status'))
    <div class="alert alert-success text-white" role="alert">
      <strong>{{session('status')}}</strong>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger text-white" role="alert">
      <strong>{{session('error')}}</strong>
    </div>
  @endif
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h3 class="float-start">Data Obat</h3>
        <a class="btn btn-outline-primary btn-sm mb-0 me-3 float-end" data-bs-toggle="modal" data-bs-target="#createMedicineModal">+ Tambah Obat</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama & Bentuk</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Batas Dosis</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
                    @foreach($result as $d)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('images/'.$d->image)}}" class="avatar avatar-xxl me-3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 id="td*generic_name*{{$d->id}}" class="mb-0 text-xl editable">{{$d->generic_name}}</h6>
                            <p id="td*form*{{$d->id}}" class="text-lrg text-secondary mb-0 editable">{{$d->form}}</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <p id="td*restriction_formula*{{$d->id}}" class="text-xs font-weight-bold mb-0 editable">{{$d->restriction_formula}}</p>
                      </td>
                      <td class="align-middle text-sm-end text-sm">
                        <p id="td*price*{{$d->id}}" class="text-lr font-weight-bold mb-0">Rp {{number_format($d->price,0,',','.')}},-</p>
                      </td>
                      <td class="align-middle">
                      <a href="#modalEdit" class="btn btn-link text-dark px-3 mb-0"  data-toggle="tooltip" data-bs-toggle="modal" onclick="getEditForm({{$d->id}})"><i class="fas fa-pencil-alt text-dark me-2"></i>Edit</a>
                        <!-- <a href="#modalEdit" class="text-dark font-weight-bold text-xs btn btn-warning" data-toggle="tooltip" data-bs-toggle="modal"  onclick="getEditForm({{$d->id}})">
                          Edit
                        </a> -->
                      </td>
                      <td class="align-middle">
                        <form method="POST" action="{{url('medicines/'.$d->id)}}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="tooltip" onclick="if(!confirm('Apakah anda yakin ingin menghapus &quot;{{$d->generic_name}} {{$d->form}}&quot; dari data obat?'))return false;"><i class="far fa-trash-alt me-2 text-danger" aria-hidden="true"></i>DELETE</button>
                          <!-- <input type="submit" class="text-light font-weight-bold text-xs btn btn-danger" value="Hapus" data-toggle="tooltip" onclick="if(!confirm('Apakah anda yakin ingin menghapus &quot;{{$d->generic_name}} {{$d->form}}&quot; dari data obat?'))return false;"> -->
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

  <div class="modal fade" id="createMedicineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('medicines.store')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Nama Obat</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan nama obat" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Bentuk Obat</label>
                <input type="text" class="form-control" name="form" placeholder="Masukkan bentuk obat" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" name="desc" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Batas Dosis</label>
                <input type="text" class="form-control" name="dose" placeholder="Masukkan batas dosis" required>
              </div>
              <div class="form-check" style="float:left; margin-right:10px;">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes1">
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 1</label>
              </div>
              <div class="form-check" style="float:left; margin-right:40px;">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes2">
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 2</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes3">
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 3</label>
              </div>
              <div class="form-group">
               <label for="exampleFormControlSelect1">Kategori Obat</label>
                <select class="form-control" name="kat">
                  @foreach($category as $c)
                    <option value="{{$c->id}}">{{$c->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Harga</label>
                <div class="input-group mb-3">
                <span class="input-group-text">Rp</span>
                <input name="price" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Gambar Obat</label>
                <div class="input-group mb-3" id="insertimage">
                </div>
                <input type="file" id="image" onchange="insertImage(this)" class="form-control" name="image" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn bg-gradient-primary">+ Tambah Data</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Obat</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
      </div>
    </div>
  </div>
</div>

  @section('javascript')
      <script>
        document.getElementById("nav_data_obat").classList.add("active");
        document.getElementById("nav_data_kategori_obat").classList.remove("active");
        document.getElementById("nav_data_pembeli").classList.remove("active");
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

        function changeImage(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#changeimage').attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
        }
      }
      function insertImage(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#insertimage').html("<div class='text-center justify-content-center align-items-center d-flex m-auto'><img src='"+e.target.result+"' class='avatar align-items-center avatar-xxl me-3'></div>");
            };

          reader.readAsDataURL(input.files[0]);
        }
      }

        
    </script>
  @endsection
@endsection