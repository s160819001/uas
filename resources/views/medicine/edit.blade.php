

<form method="POST" action="{{url('medicines/'.$data->id)}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="exampleFormControlInput1">Nama Obat</label>
                <input type="text" class="form-control" value="{{$data->generic_name}}" name="name" placeholder="Masukkan nama obat" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Bentuk Obat</label>
                <input type="text" class="form-control" value="{{$data->form}}" name="form" placeholder="Masukkan bentuk obat" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" name="desc" rows="3" required>{{$data->description}}</textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Batas Dosis</label>
                <input type="text" class="form-control" value="{{$data->restriction_formula}}" name="dose" placeholder="Masukkan batas dosis" required>
              </div>
              <div class="form-check" style="float:left; margin-right:10px;">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes1" <?php if($data->faskes_tk1!=0 && $data->faskes_tk1!=null) echo "checked" ?>>
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 1</label>
              </div>
              <div class="form-check" style="float:left; margin-right:40px;">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes2"<?php if($data->faskes_tk2!=0 && $data->faskes_tk2!=null) echo "checked"; ?>>
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 2</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="checkFaskes3"<?php if($data->faskes_tk3!=0 && $data->faskes_tk3!=null) echo "checked"; ?>>
                <label class="custom-control-label" for="customCheck1">Faskes Tk. 3</label>
              </div>
              <div class="form-group">
               <label for="exampleFormControlSelect1">Kategori Obat</label>
                <select class="form-control" name="kat">
                  @foreach($category as $c)
                  @if($c->id==$data->category_id)
                    <option value="{{$c->id}}" selected>{{$c->category_name}}</option>
                    @else
                    <option value="{{$c->id}}" >{{$c->category_name}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Harga</label>
                <div class="input-group mb-3">
                <span class="input-group-text">Rp</span>
                <input name="price" type="number" value="{{$data->price}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Gambar</label>
                <div class="input-group mb-3">
                <div class="text-center justify-content-center align-items-center d-flex m-auto">
                            <img id="changeimage" src="{{asset('images/'.$data->image)}}" class="avatar align-items-center avatar-xxl me-3">
                          </div>
</div>
                <input type="file" id="image" onchange="changeImage(this)" class="form-control" name="image">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn bg-gradient-primary">Ubah Data</button>
              </div>
            </form>
