<?php $__env->startSection('title','Museum Artefacts || HOME PAGE'); ?>
<?php $__env->startSection('main-content'); ?>
<!-- Slider Area -->

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#Gslider" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <!-- Replace 'path/to/image.jpg' with the actual path of the banner image -->
            <img class="first-slide" src="<?php echo e(asset('photos/Banner/1715653207.jpg')); ?>" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-left">
                <!-- Replace 'Your Title Here' and 'Your description here' with actual content -->
                <h1 class="wow fadeInDown">Museum Artefacts</h1>
                <p>You Found Museum Artifacts</p>
                <a class="btn btn-lg ws-btn wow fadeInUpBig" href="<?php echo e(route('product-grids')); ?>" role="button">Discover<i class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
        <div class="carousel-item">
            <!-- Replace 'path/to/image.jpg' with the actual path of the banner image -->
            <img class="first-slide" src="<?php echo e(asset('photos/Banner/171565207.jpg')); ?>" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-left">
                <!-- Replace 'Your Title Here' and 'Your description here' with actual content -->
                <h1 class="wow fadeInDown">Museum Artefacts</h1>
                <p>You Found Museum Artifacts</p>
                <a class="btn btn-lg ws-btn wow fadeInUpBig" href="<?php echo e(route('product-grids')); ?>" role="button">Discover<i class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>


<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            <?php
            $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
            ?>
            <?php if($category_lists): ?>
            <?php $__currentLoopData = $category_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($cat->is_parent==1): ?>
            <!-- Single Banner  -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    <?php if($cat->photo): ?>
                    <img src="<?php echo e(asset($cat->photo)); ?>" alt="<?php echo e($cat->photo); ?>">
                    <?php else: ?>
                    <img src="https://via.placeholder.com/600x370" alt="#">
                    <?php endif; ?>
                    <div class="content">
                        <h3><?php echo e($cat->title); ?></h3>
                        <a href="<?php echo e(route('product-cat',$cat->slug)); ?>">Discover Now</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- /End Single Banner  -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>New Items</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            <?php
                            $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                            // dd($categories);
                            ?>
                            <?php if($categories): ?>
                            <button class="btn" style="background:black" data-filter="*">
                                Recently Added
                            </button>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <button class="btn" style="background:none;color:black;" data-filter=".<?php echo e($cat->id); ?>">
                                <?php echo e($cat->title); ?>

                            </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content isotope-grid" id="myTabContent">
                        <?php
                        $recentlyAddedProducts = DB::table('products')
                        ->where('status', 'active')
                        ->orderBy('created_at', 'desc')
                        ->take(8) // Get the 8 most recently added products
                        ->get();
                        ?>

                        <?php $__currentLoopData = $recentlyAddedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo e($product->cat_id); ?>">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="<?php echo e(route('product-detail', $product->slug)); ?>">
                                        <?php
                                        $photos = explode(',', $product->photo);
                                        ?>
                                        <img class="default-img" src="<?php echo e(asset($photos[0])); ?>" alt="<?php echo e($photos[0]); ?>">
                                        <img class="hover-img" src="<?php echo e(asset($photos[0])); ?>" alt="<?php echo e($photos[0]); ?>">
                                        <?php if($product->stock <= 0): ?>
                                            <span class="out-of-stock">Sold Out</span>
                                            <?php elseif($product->condition == 'new'): ?>
                                            <span class="new">New</span>
                                            <?php elseif($product->condition == 'hot'): ?>
                                            <span class="hot">Hot</span>
                                            <?php else: ?>
                                            <span class="price-dec"><?php echo e($product->discount); ?>% Off</span>
                                            <?php endif; ?>
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#<?php echo e($product->id); ?>" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="<?php echo e(route('add-to-wishlist', $product->slug)); ?>"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a title="Add to cart" href="<?php echo e(route('add-to-cart', $product->slug)); ?>">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="<?php echo e(route('product-detail', $product->slug)); ?>"><?php echo e($product->title); ?></a></h3>
                                    <?php
                                    $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                    ?>
                                    <div class="product-price">
                                        <span>$<?php echo e(number_format($after_discount, 2)); ?></span>
                                        <del style="padding-left: 4%;">$<?php echo e(number_format($product->price, 2)); ?></del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

<!-- Start Midium Banner  -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            <?php if($featured): ?>
            <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Single Banner  -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <?php
                    $photo=explode(',',$data->photo);
                    ?>
                    <img src="<?php echo e(asset($photo[0])); ?>" alt="<?php echo e($photo[0]); ?>">
                    <div class="content">
                        <p><?php echo e($data->cat_info['title']); ?></p>
                        <h3><?php echo e($data->title); ?> <br>Up to<span> <?php echo e($data->discount); ?>%</span></h3>
                        <a href="<?php echo e(route('product-detail',$data->slug)); ?>">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- /End Single Banner  -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End Midium Banner -->

<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    <?php $__currentLoopData = $product_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($product->condition=='hot'): ?>
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-img">
                            <a href="<?php echo e(route('product-detail',$product->slug)); ?>">
                                <?php
                                $photo=explode(',',$product->photo);
                                // dd($photo);
                                ?>
                                <img class="default-img" src="<?php echo e(asset($photo[0])); ?>" alt="<?php echo e($photo[0]); ?>">
                                <img class="hover-img" src="<?php echo e(asset($photo[0])); ?>" alt="<?php echo e($photo[0]); ?>">
                                
                            </a>
                            <div class="button-head">
                                <div class="product-action">
                                    <a data-toggle="modal" data-target="#<?php echo e($product->id); ?>" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                    <a title="Wishlist" href="<?php echo e(route('add-to-wishlist',$product->slug)); ?>"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                </div>
                                <div class="product-action-2">
                                    <a href="<?php echo e(route('add-to-cart',$product->slug)); ?>">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="<?php echo e(route('product-detail',$product->slug)); ?>"><?php echo e($product->title); ?></a></h3>
                            <div class="product-price">
                                <span class="old">$<?php echo e(number_format($product->price,2)); ?></span>
                                <?php
                                $after_discount=($product->price-($product->price*$product->discount)/100)
                                ?>
                                <span>$<?php echo e(number_format($after_discount,2)); ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                    ?>
                    <?php $__currentLoopData = $product_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <!-- Start Single List  -->
                        <div class="single-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        <?php
                                        $photo=explode(',',$product->photo);
                                        // dd($photo);
                                        ?>
                                        <img src="<?php echo e($photo[0]); ?>" alt="<?php echo e(asset($photo[0])); ?>">
                                        <a href="<?php echo e(route('add-to-cart',$product->slug)); ?>" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="<?php echo e(route('product-detail',$product->slug)); ?>"><?php echo e($product->title); ?></a></h4>
                                        <p class="price with-discount"><?php echo e(number_format($product->discount,2)); ?>% OFF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single List  -->
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->



<!-- Modal -->
<?php if($product_lists): ?>
<?php $__currentLoopData = $product_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="<?php echo e($product->id); ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                <?php
                                $photo=explode(',',$product->photo);
                                // dd($photo);
                                ?>
                                <?php $__currentLoopData = $photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-slider">
                                    <img src="<?php echo e(asset($data)); ?>" alt="<?php echo e($data); ?>">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2><?php echo e($product->title); ?></h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                   
                                </div>
                                <div class="quickview-stock">
                                    <?php if($product->stock >0): ?>
                                    <span><i class="fa fa-check-circle-o"></i> <?php echo e($product->stock); ?> in stock</span>
                                    <?php else: ?>
                                    <span><i class="fa fa-times-circle-o text-danger"></i> <?php echo e($product->stock); ?> out stock</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $after_discount=($product->price-($product->price*$product->discount)/100);
                            ?>
                            <h3><small><del class="text-muted">$<?php echo e(number_format($product->price,2)); ?></del></small> $<?php echo e(number_format($after_discount,2)); ?> </h3>
                            <div class="quickview-peragraph">
                                <p><?php echo html_entity_decode($product->summary); ?></p>
                            </div>
                          
                            <form action="<?php echo e(route('single-add-to-cart')); ?>" method="POST" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">
                                        <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <button type="submit" class="btn">Add to cart</button>
                                    <a href="<?php echo e(route('add-to-wishlist',$product->slug)); ?>" class="btn min"><i class="ti-heart"></i></a>
                                </div>
                            </form>
                            <div class="default-social">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!-- Modal end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Banner Sliding */
    #Gslider .carousel-inner {
        background: #000000;
        color: black;
    }

    #Gslider .carousel-inner {
        height: 550px;
    }

    #Gslider .carousel-inner img {
        width: 100% !important;
        opacity: .8;
    }

    #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
    }

    #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        /* color: #F7941D; */
        color: #1e1e1e;
    }

    #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
    }

    #Gslider .carousel-indicators {
        bottom: 70px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    /*==================================================================
        [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function() {
        $filter.on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({
                filter: filterValue
            });
        });

    });

    // init Isotope
    $(window).on('load', function() {
        var $grid = $topeContainer.each(function() {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function() {
        $(this).on('click', function() {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });
</script>
<script>
    function cancelFullScreen(el) {
        var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
        if (requestMethod) { // cancel full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }

    function requestFullScreen(el) {
        // Supports most browsers and their versions.
        var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

        if (requestMethod) { // Native full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
        return false
    }
</script>
<?php if(!Auth::check()): ?>
<script>
    window.onload = function() {
        if (!localStorage.getItem('ageVerified')) {
            verifyAge();
        }
    };
</script>
<?php endif; ?>

<script>
    function verifyAge() {
        Swal.fire({
            // title: 'Age Verification',
            text: 'Are you Over 18?',
            iconHtml: '<img src="<?php echo e(asset('
            photos / Logo / logo.png ')); ?>" alt="Logo" style="width: 100px; height: auto;">',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            // reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed to your website's content
                localStorage.setItem('ageVerified', 'true');
                window.location.href = "#";
            } else {
                // Redirect to Google.com
                redirectToGoogle();
            }
        });
    }

    function redirectToGoogle() {
        window.location.href = "https://www.google.com";
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Museum\resources\views/frontend/index.blade.php ENDPATH**/ ?>