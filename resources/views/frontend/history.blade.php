@extends('layouts.frontend')

@section('title', 'Riwayat Transaksi')

@section('content')
@if(session('error'))
    <div class="alert alert-danger text-white" role="alert">
      <strong>{{session('error')}}</strong>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                  <h3 class="float-start">Riwayat Transaksi</h3>
                </div>

                <div class="card-body">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu Transaksi</th>
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
                            <p class="text-xs font-weight-bold mb-0">{{$d->transaction_date}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-xs font-weight-bold mb-0">Rp {{number_format($d->total,0,',','.')}},-</p>
                          </td>
                          <td class="align-middle">
                            <a href="{{route('transactions.show',$d->id)}}" class="text-light font-weight-bold text-xs btn btn-info" data-toggle="tooltip" data-original-title="detail">
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


@endsection
