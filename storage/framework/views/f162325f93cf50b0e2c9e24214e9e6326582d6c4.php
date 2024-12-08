<!-- Start Footer Area -->
<footer class="footer">
	<!-- Footer Top -->
	<div class="footer-top section">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer about">
						<div class="logo" style="max-width: 30%; height: auto;">
							<a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('photos/Logo/logo.png')); ?>" alt="Cosmose Logo"></a>
						</div>
						<p class="text">At Museum Artefacts, we believe in bringing the past to life by offering you access to some of the world’s most treasured artefacts from our renowned collection. Our mission is to make these historical masterpieces available to everyone by providing high-quality digital images and replicas. Whether you're an art lover, history enthusiast, or a student, we aim to offer a unique way for you to explore and enjoy our rich cultural heritage.</p>
						<p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">123456789</a></span></p>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer links">
						<h4>Information</h4>
						<ul>
							<li><a href="<?php echo e(route('about-us')); ?>">About Us</a></li>
							<li><a href="#">Faq</a></li>
							<li><a href="#">Terms & Conditions</a></li>
							<li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
							<li><a href="#">Help</a></li>
						</ul>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer links">
						<h4>Customer Service</h4>
						<ul>
							<li><a href="#">Payment Methods</a></li>
							<li><a href="#">Money-back</a></li>
							<li><a href="#">Returns</a></li>
							<li><a href="#">Shipping</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer social">
						<h4>Get In Tuch</h4>
						<!-- Single Widget -->
						<div class="contact">
							<ul>
								<li>Museum of Modern Art, New York</li>
								<li>info@test.com</li>
								<li>123456789</li>
							</ul>
						</div>
						<!-- End Single Widget -->
						<div class="sharethis-inline-follow-buttons"></div>
					</div>
					<!-- End Single Widget -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Footer Top -->
	<div class="copyright">
		<div class="container">
			<div class="inner">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="left">
							<p>© <?php echo e(date('Y')); ?> Developed By Museum Artefacts. - All Rights Reserved.</p>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="right">
							<img src="<?php echo e(asset('backend/img/payments.png')); ?>" alt="#">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery-migrate-3.0.0.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery-ui.min.js')); ?>"></script>
<!-- Popper JS -->
<script src="<?php echo e(asset('frontend/js/popper.min.js')); ?>"></script>
<!-- Bootstrap JS -->
<script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
<!-- Color JS -->
<script src="<?php echo e(asset('frontend/js/colors.js')); ?>"></script>
<!-- Slicknav JS -->
<script src="<?php echo e(asset('frontend/js/slicknav.min.js')); ?>"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo e(asset('frontend/js/owl-carousel.js')); ?>"></script>
<!-- Magnific Popup JS -->
<script src="<?php echo e(asset('frontend/js/magnific-popup.js')); ?>"></script>
<!-- Waypoints JS -->
<script src="<?php echo e(asset('frontend/js/waypoints.min.js')); ?>"></script>
<!-- Countdown JS -->
<script src="<?php echo e(asset('frontend/js/finalcountdown.min.js')); ?>"></script>
<!-- Nice Select JS -->
<script src="<?php echo e(asset('frontend/js/nicesellect.js')); ?>"></script>
<!-- Flex Slider JS -->
<script src="<?php echo e(asset('frontend/js/flex-slider.js')); ?>"></script>
<!-- ScrollUp JS -->
<script src="<?php echo e(asset('frontend/js/scrollup.js')); ?>"></script>
<!-- Onepage Nav JS -->
<script src="<?php echo e(asset('frontend/js/onepage-nav.min.js')); ?>"></script>

<script src="<?php echo e(asset('frontend/js/isotope/isotope.pkgd.min.js')); ?>"></script>
<!-- Easing JS -->
<script src="<?php echo e(asset('frontend/js/easing.js')); ?>"></script>

<!-- Active JS -->
<script src="<?php echo e(asset('frontend/js/active.js')); ?>"></script>


<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
	setTimeout(function() {
		$('.alert').slideUp();
	}, 5000);
	$(function() {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
		$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
			event.preventDefault();
			event.stopPropagation();

			$(this).siblings().toggleClass("show");


			if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
			}
			$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
			});

		});
	});
</script><?php /**PATH C:\xampp\htdocs\Museum\resources\views/frontend/layouts/footer.blade.php ENDPATH**/ ?>