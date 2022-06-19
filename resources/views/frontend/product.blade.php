@extends('layouts.frontend')

@section('title', 'Apotik U')

@section('content')
@if(session('success'))
    <div class="alert alert-success text-white" role="alert">
        <strong>{{session('success')}}</strong>
    </div>
 @endif
 @if(session('status'))
    <div class="alert alert-success text-white" role="alert">
        <strong>{{session('status')}}</strong>
    </div>
 @endif

    <div class="container products">

        <div class="card mb-4">
            <div class="card-body p-3">
              <div class="row p-xxl-0">
                @foreach($medicines as $m)
                <div class="card w-30 mx-3 my-4 align-items-center" style="position : relative;">
                    <div class="align-items-start">
                  <div class="card card-blog card-plain mb-7 justify-content-start ">
                    <div class="position-relative">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('images/'.$m->image)}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl d-flex m-auto" style="min-height: 20vw; max-height: 20vw; min-width: 24vw !important;">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      
                      <a href="javascript:;">
                        <h5>
                            {{$m->generic_name}}
                        </h5>
                      </a>
                      <p class="text-gradient text-dark mb-2 text-lg">{{$m->form}}</p>
                      <p class="mb-4 text-sm">
                        Catatan: {{$m->description}}
                      </p>
                      <p class="mb-4 text-sm text-danger">
                        Batas Dosis: {{$m->restriction_formula}}
                      </p>
                    </div>
                  </div>
                    </div>
                  
                  <div class=" align-items-center justify-content-center w-100 p-2" style="position : absolute; bottom:0px;">
                        <a href="{{url('add-to-cart/'.$m->id)}}" role="button" class="btn btn-outline-primary btn-lg w-100 text-lg"><i class="ni ni-cart p" aria-hidden="true"></i>&nbsp;&nbsp;Rp {{number_format($m->price,0,',','.')}},-</a>
                        
                      </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>

    </div>

@endsection