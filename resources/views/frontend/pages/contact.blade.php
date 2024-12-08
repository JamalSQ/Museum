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
							<li class="active"><a href="javascript:void(0);">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
  
	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
			<div class="contact-head">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="form-main">
							<div class="title">
								<h4>Contact Us</h4>
								<p>We'd love to hear from you! If you have any questions, concerns, or feedback, please reach out to us. Our team is here to help and will get back to you as soon as possible.</p>
								<p>**Contact Information:**</p>
								<ul>
									<li><strong>Phone:</strong> 1234556789</li>
									<li><strong>Email:</strong> <a href="mailto:info@yourwebsite.com">info@yourwebsite.com</a></li>
									<li><strong>Address:</strong> Museum of Modern Art, New York</li>
								</ul>
								<p>Thank you for your interest in Museum Artefacts! We look forward to connecting with you.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="single-head">
							<div class="single-info">
								<i class="fa fa-phone"></i>
								<h4 class="title">Call us Now:</h4>
								<ul>
									<li>1234556789</li>
								</ul>
							</div>
							<div class="single-info">
								<i class="fa fa-envelope-open"></i>
								<h4 class="title">Email:</h4>
								<ul>
									<li><a href="mailto:info@yourwebsite.com">info@yourwebsite.com</a></li>
								</ul>
							</div>
							<div class="single-info">
								<i class="fa fa-location-arrow"></i>
								<h4 class="title">Our Address:</h4>
								<ul>
									<li>Museum of Modern Art, New York</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Contact -->
	
	<!-- Map Section -->
	<div class="map-section">
		<div id="myMap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14130.857353934944!2d85.36529494999999!3d27.6952226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sne!2snp!4v1595323330171!5m2!1sne!2snp" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		</div>
	</div>
	<!--/ End Map Section -->

@endsection

@push('styles')
<style>
	.modal-dialog .modal-content .modal-header{
		position:initial;
		padding: 10px 20px;
		border-bottom: 1px solid #e9ecef;
	}
	.modal-dialog .modal-content .modal-body{
		height:100px;
		padding:10px 20px;
	}
	.modal-dialog .modal-content {
		width: 50%;
		border-radius: 0;
		margin: auto;
	}
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush
