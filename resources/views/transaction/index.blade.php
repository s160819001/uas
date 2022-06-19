
@extends('layout.softui')
@section('content')

<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h3 class="float-start">Data Pembeli</h3>
              <!-- <a class="btn btn-outline-primary btn-sm mb-0 me-3 float-end" href="/">+ Tambah Transaksi</a> -->
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembeli</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($result as $d)
                    <tr>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{$d->id}}</p>
                      </td>
                      <td class="align-middle">
                        <p class="text-xs font-weight-bold mb-0">{{$d->buyer->name}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{$d->transaction_date}}</p>
                      </td>
                      <td class="align-middle text-end">
                        <p class="text-xs font-weight-bold mb-0 text-right">Rp {{number_format($d->total,0,',','.')}},-</p>
                      </td>
                      <td class="align-middle">
                        <a href="{{route('transactions.show',$d->id)}}" class="text-light font-weight-bold text-xs btn btn-info" data-toggle="tooltip" data-original-title="Edit user">
                          Detail
                        </a>
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
       document.getElementById("nav_data_pembeli").classList.add("active");
        document.getElementById("nav_best_selling_report").classList.remove("active");
        document.getElementById("nav_top_spender_report").classList.remove("active");
    </script>
    @endsection

@endsection