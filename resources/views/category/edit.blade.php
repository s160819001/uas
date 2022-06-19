
<!-- form untuk mengirim hasil edit ke category controller update menggunakan resource controller dengan uri
 categories/id-nya dengan method put==actionupdate masuk routing categories.update -->
<form method="POST" action="{{url('categories/'.$data->id)}}">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="exampleFormControlInput1">Kategori Obat</label>
                <!-- set value dari textbox dengan data yang dikirim dari controller getEditForm -->
                <input type="text" class="form-control" value="{{$data->category_name}}" name="name" placeholder="Masukkan kategori obat" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn bg-gradient-primary">Ubah Data</button>
              </div>
            </form>