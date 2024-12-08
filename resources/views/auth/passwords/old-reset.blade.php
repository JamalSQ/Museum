@extends('frontend.layouts.master')


@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
            <li class="active"><a href="javascript:void(0);">Forgot Your Password?</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shop Login -->
<section class="shop login section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3 col-12">
        <div class="login-form">
          <h2>Forgot Your Password?</h2>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <form class="user" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Your Email<span>*</span></label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group login-btn">
                  <button class="btn btn-facebook" type="submit">Reset Password</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Login -->
@endsection
@push('styles')
<style>
  .shop.login .form .btn {
    margin-right: 0;
  }

  .btn-facebook {
    background: #39579A;
  }

  .btn-facebook:hover {
    background: #073088 !important;
  }

  .btn-github {
    background: #444444;
    color: white;
  }

  .btn-github:hover {
    background: black !important;
  }

  .btn-google {
    background: #ea4335;
    color: white;
  }

  .btn-google:hover {
    background: rgb(243, 26, 26) !important;
  }
</style>
@endpush