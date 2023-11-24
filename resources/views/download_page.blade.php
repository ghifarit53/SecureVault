@extends('layout')
@section('additional')
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('container')
@if(session()->has('keyError'))
  {{ session('keyError') }}
@endif

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                @if(session('success'))
                echo $request;
                @else
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Download File</h3>
              <form action="{{ route('download', ['id' => $value]) }}" id="downloadForm" method="POST">
                @csrf
                <input type="text" id="key" name="input" class="form-control form-control-lg" placeholder="Enter the Encryption Key"/><br>
                <div class="d-flex justify-content-center">
                  <div class="btn btn-primary btn-rounded">
                      <input class="form-label text-white m-1" type="submit" value="Download"/>
                  </div>
              </div>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})

@endsection