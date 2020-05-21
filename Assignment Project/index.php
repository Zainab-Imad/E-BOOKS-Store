<?php
include 'admin/includes/connection.php';
include 'header.php';
?>

		<!-- End Search Popup -->
        <!-- Start Slider area -->
        <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
        	<!-- Start Single Slide -->
	        <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-lg-12">
	            			<div class="slider__content">
		            			<div class="contentbox">
		            				<h2>Buy <span>your </span></h2>
		            				<h2>favourite <span>Book </span></h2>
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="#">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
            <!-- End Single Slide -->
        	<!-- Start Single Slide -->
	        <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-lg-12">
	            			<div class="slider__content">
		            			<div class="contentbox">
		            				<h2>Buy <span>your </span></h2>
		            				<h2>favourite <span>Book </span></h2>
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="#">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
            <!-- End Single Slide -->
        </div>
        <!-- End Slider area -->
		<!-- Start BEst Seller Area -->
		<section class="wn__product__area brown--color pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">New <span class="color--theme">Products</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
					<!-- Start Single Product -->
					<?php
											$query = "select product.pro_id,img_one,img_two,pro_price,pro_name,product.cat_id,cat_name from product inner join image on product.pro_id=image.pro_id 
                                                      inner join category on product.cat_id=category.cat_id
                                                      order by product.pro_id desc limit 15";
											$result = mysqli_query($conn,$query);
											while ($pro=mysqli_fetch_assoc($result)) {
												# code...
											
											?>

					<div class="product product__style--3">
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="product__thumb">
								<a class="first__img" href="single-product.php?proId=<?php echo $pro['pro_id'] ?>"><img height="340px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_one']?>" alt="product image"></a>
								<a class="second__img animation1" href="single-product.php?proId=<?php echo $pro['pro_id']; ?>"><img height="340px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_two'] ?>" alt="product image"></a>
								<div class="hot__box">
									<span class="hot-label">Hot</span>
								</div>
							</div>
							<div class="product__content content--center">
								<h4><a href="single-product.php?proId=<?php echo $pro['pro_id']; ?>"><?php echo $pro['pro_name']; ?></a></h4>
								<ul class="prize d-flex">
									<li>$ <?php echo $pro['pro_price']; ?></li>
								</ul>
								<div class="action">
									<div class="actions_inner">
										<ul class="add_to_links">
											<li><a class="cart button btn" href="index.php?qty=1&cart=<?php echo $pro['pro_id'] ?>"><i class="bi bi-shopping-bag4"></i></a></li>
                                            <li><a class="wishlist" pro="<?php echo $pro['pro_id'] ?>" name="wishlist"><i class="bi bi-heart-beat"></i></a></li>
                                            <li><a data-toggle="modal" pro-data="<?php echo $pro['pro_id'] ?>" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
										</ul>
									</div>

								</div>
                                <div class="product__hover--content">
                                    <ul class="rating d-flex">
                                        <li style="color: #e59285">$ <?php echo $pro['pro_price']; ?></li>
                                    </ul>
                                </div>
							</div>
						</div>
					</div>


					<?php
				}
					?>
					<!-- Start Single Product -->
					
				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start NEwsletter Area -->
		<section class="wn__newsletter__area bg-image--2">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
						<div class="section__title text-center">
							<h2>Stay With Us</h2>
						</div>
						<div class="newsletter__block text-center">
							<p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers.</p>
							<form action="mail.php" method="post">
								<div class="newsletter__box">
									<input type="email" placeholder="Enter your e-mail" name="email">
									<input type="submit" name="send">Subscribe</input>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End NEwsletter Area -->
		<!-- Start Best Seller Area -->
		<section class="wn__bestseller__area bg--white pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">All <span class="color--theme">Products</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<div class="row mt--50">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="product__nav nav justify-content-center catty " role="tablist">
							<style type="text/css">.catty a{line-height: 40px;}</style>
							<?php 
							$query = "select * from category";
							$result = mysqli_query($conn,$query);
							while ($cat = mysqli_fetch_assoc($result)) {
								# code...
								echo "<a class='nav-item nav-link' href='shop-grid.php?catId={$cat['cat_id']}' role='tab'>{$cat['cat_name']}</a>";
							}
							?>
                        </div>
					</div>
				</div>
				<div class="tab__container mt--60">
					<!-- Start Single Tab Content -->
					<div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
						<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
							
								<!-- Start Single Product -->
								<?php
											$query = "select product.pro_id,img_one,img_two,pro_price,pro_name,product.cat_id,cat_name from product inner join image on product.pro_id=image.pro_id 
                                                      inner join category on product.cat_id=category.cat_id
                                                      order by product.pro_id asc ";
											$result = mysqli_query($conn,$query);
											while ($pro=mysqli_fetch_assoc($result)) {
												# code...
											
											?>
                                                <div class="single__product">
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="product product__style--3">
										<div class="product__thumb">
											<a class="first__img" href="single-product.php?proId=<?php echo $pro['pro_id'] ?>"><img height="340px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_one']?>" alt="product image"></a>
											<a class="second__img animation1" href="single-product.php?proId=<?php echo $pro['pro_id']; ?>"><img height="340px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_two']?>" alt="product image"></a>
											<div class="hot__box">
												<span class="hot-label">BEST SALLER</span>
											</div>
										</div>
										<div class="product__content content--center content--center">
											<h4><a href="single-product.php?proId=<?php echo $pro['pro_id'] ?>"><?php echo $pro['pro_name'].$pro['pro_id']; ?></a></h4>
											<ul class="prize d-flex">
												<li>$ <?php echo $pro['pro_price']; ?></li>
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="cart button btn" href="index.php?qty=1&cart=<?php echo $pro['pro_id']; ?>"><i class="bi bi-shopping-bag4"></i></a></li>
                                                        <li><a class="wishlist" pro="<?php echo $pro['pro_id'] ?>" name="wishlist"><i class="bi bi-heart-beat"></i></a></li>
                                                        <li><a data-toggle="modal" title="Quick View" pro-data="<?php echo $pro['pro_id'] ?>" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
													</ul>
												</div>
											</div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li style="color: #e59285">$ <?php echo $pro['pro_price']; ?></li>
                                                </ul>

                                            </div>
										</div>
									</div>
								</div></div>
							<?php }?>
								<!-- Start Single Product -->
				</div>
			</div></div></div></div>
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start Recent Post Area -->
		<section class="wn__recent__post bg--gray ptb--80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<div class="row mt--50">
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">International activities of the Frankfurt Book </a></h3>
								<p>We are proud to announce the very first the edition of the frankfurt news.We are proud to announce the very first of  edition of the fault frankfurt news for us.</p>
								<div class="post__time">
									<span class="day">Dec 06, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">Reading has a signficant info  number of benefits</a></h3>
								<p>Find all the information you need to ensure your experience.Find all the information you need to ensure your experience . Find all the information you of.</p>
								<div class="post__time">
									<span class="day">Mar 08, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">The London Book Fair is to be packed with exciting </a></h3>
								<p>The London Book Fair is the global area inon marketplace for rights negotiation.The year  London Book Fair is the global area inon forg marketplace for rights.</p>
								<div class="post__time">
									<span class="day">Nov 11, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Recent Post Area -->
		<!-- Best Sale Area -->
		<section class="best-seel-area pt--80 pb--60">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center pb--50">
							<h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
			</div>
			<div class="slider center">
				<!-- Single product start -->
<?php
$query = "select pro_id,pro_name,img_one,price,cat_name,sum(qty) from orderdetails GROUP BY pro_id";
$result = mysqli_query($conn,$query);
while ($pro=mysqli_fetch_assoc($result)) {
    # code...

    ?>
				<div class="product product__style--3">
					<div class="product__thumb">
						<a class="first__img" href="single-product.html"><img width="304" height="384" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_one']; ?>" alt="product image"></a>
					</div>
					<div class="product__content content--center">
						<div class="action">
							<div class="actions_inner">
								<ul class="add_to_links">
									<li><a class="cart btn" href="index.php?qty=1&cart=<?php echo $pro['pro_id']; ?>"><i class="bi bi-shopping-bag4"></i></a></li>
                                    <li><a class="wishlist" pro="<?php echo $pro['pro_id'] ?>" name="wishlist"><i class="bi bi-heart-beat"></i></a></li>
                                    <li><a data-toggle="modal" title="Quick View" pro-data="<?php echo $pro['pro_id'] ?>" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
								</ul>
							</div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li style="color: #e59285; margin-top: 20px;margin-right: 10px;">$ <?php echo $pro['price']; ?></li>
                                </ul>

                            </div>
						</div>
					</div>
				</div>
<?php }?>
				<!-- Single product end -->
					</div>
		</section>
		<!-- Best Sale Area Area -->
		<!-- Footer Area -->
		
<?php include 'footer.php';