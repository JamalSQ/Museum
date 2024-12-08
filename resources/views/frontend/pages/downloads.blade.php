@extends('frontend.layouts.master')

@section('title', 'Museum Artefacts || Downloads')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs" style="background-color: #f7f7f7; padding: 10px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Downloads</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Style 1 -->
    <section class="product-area shop-sidebar shop-list shop section" style="padding: 60px 0;">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <!-- Start Single List  -->
                        <div class="single-list" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 30px; border-radius: 8px; overflow: hidden;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay" style="position: relative;">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        <img src="{{ asset($photo[0]) }}" alt="{{ $product->title }}" class="img-fluid" style="width: 100%; height: auto;">
                                        @if($product->mainfile)
                                            <a href="{{ asset($product->mainfile) }}" class="buy" download style="position: absolute; bottom: 10px; right: 10px; background-color: #8c52ff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-content" style="padding: 20px;">
                                        <h4 style="font-size: 18px; font-weight: bold; color: #333;">{{ $product->title }}</h4>
                                        <!-- Optional: Add Price or other information -->
                                        <p style="font-size: 16px; color: #000;">${{ $product->price ?? 'Free' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single List  -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--/ End Product Style 1  -->

@endsection

@push('styles')
<style>
    .pagination {
        display: inline-flex;
        justify-content: center;
        margin-top: 30px;
        list-style: none;
        padding: 0;
    }
    .pagination li {
        margin: 0 5px;
    }
    .pagination a {
        text-decoration: none;
        padding: 8px 16px;
        background-color: #8c52ff;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .pagination a:hover {
        background-color: #6a2abc;
    }
    .pagination .active a {
        background-color: #6a2abc;
        pointer-events: none;
    }
    .buy {
        display: inline-flex;
        align-items: center;
        background-color: #8c52ff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .buy:hover {
        background-color: #6a2abc;
    }
    .list-content {
        background-color: #fff;
        padding: 20px;
        border-top: 1px solid #eee;
    }

    @media (max-width: 768px) {
        .product-area .single-list {
            margin-bottom: 20px;
        }
        .product-area .col-md-4 {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
