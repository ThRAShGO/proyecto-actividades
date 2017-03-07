<?php
/**
* The template for displaying Author Archive pages.
*/

get_header(); ?>

<nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="mobnav-btn"></div>
			<ul class="sf-menu">
				<li class="normal_drop_down">
				<a href="#">Home</a>
				<div class="mobnav-subarrow"></div>
				<ul>
					<li><a href="index.html">Revolution version</a></li>
					<li><a href="index_2.html">Subscription version</a></li>
					<li><a href="index_3.html">With Ajax Search bar</a></li>
                    <li><a href="index_4.html">With Video</a></li>
				</ul>
				</li>
				<li class="normal_drop_down">
				<a href="#">Course</a>
				<div class="mobnav-subarrow"></div>
				<ul>
                	<li><a href="courses_grid.html">Courses grid</a></li>
                    <li><a href="courses_list.html">Courses list</a></li>
                    <li><a href="course_detail_page_txt.html ">Course page Txt</a></li>
                    <li><a href="course_detail_page_video.html ">Course page Video</a></li>
                    <li><a href="course_details_4.html">Course details v1</a></li>
                    <li><a href="course_details_5.html">Course details v2</a></li>
                    <li><a href="course_details_2.html">Course details v3</a></li>
					<li><a href="course_details_1.html">Course details v4</a></li>
                    <li><a href="course_details_3.html">Course details v5</a></li>
                    <li><a href="course_timeline.html">Seminar timeline</a></li>
				</ul>
				</li>
				<li><a href="prices_plans.html">Prices &amp; Plans</a></li>
				<li><a href="blog.html">Blog</a></li>
                <li class="mega_drop_down">
				<a href="#">Pages (Megamenu)</a>
                <div class="mobnav-subarrow"></div>
                <div class="sf-mega">
                	<div class="col-md-4 col-sm-6">
                    	<h5>Communicate</h5>
                            <ul class="mega_submenu">
                            	<li><a href="about_us.html">About us</a></li>
								<li><a href="teachers.html">Teachers</a></li>
                                <li><a href="teacher_profile.html">Teacher profile</a></li>
                                <li><a href="member_profile.html">Member profile</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="events_news_list.html">News &amp; Events</a></li>
                            </ul>
                    </div>
                  <div class="col-md-4 col-sm-6">
                   <h5>Other pages</h5>
                          <ul class="mega_submenu">
                           	  <li><a href="apply.html">PHP working wizard apply</a></li>
                              <li><a href="apply_2.html">PHP working apply</a></li>
                              <li><a href="login.html">Login</a></li>
                              <li><a href="register.html">Register</a></li>
                              <li><a href="shortcodes.html">Shortcodes</a></li>
                              <li><a href="gallery.html">Photo &amp; video gallery <img src="img/new.png" alt=""></a></li>
                          </ul>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    <h5>Submenu with icons</h5>
                            <ul class="mega_submenu icons">
                            	<li><a href="#"> Downloads<i class="icon-download"></i></a></li>
                                <li><a href="#">Video files <i class="icon-video"></i></a></li>
                                <li><a href="#">Audio files <i class="icon-mic"></i></a></li>
                                <li><a href="#">Members <i class="icon-user"></i></a></li>
                            </ul>
                    </div>
                </div>
                </li>
				<li><a href="contacts.html">Contacts</a></li>
			</ul>
            
            <div class="col-md-3 pull-right hidden-sm hidden-xs">
                    <div id="sb-search" class="sb-search">
						<form>
							<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
							<input class="sb-search-submit" type="submit" value="">
							<span class="sb-icon-search"></span>
						</form>
					</div>
              </div><!-- End search -->
              
		</div>
	</div><!-- End row -->
</div><!-- End container -->
</nav>

<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1>Teachers</h1>
			<p class="lead">Caulie <strong>dandelion</strong> maize lentil collard greens radish arugula sweet pepper water.</p>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->

<section id="main_content">

<div class="container">

<ol class="breadcrumb">
  <li><a href="index.html">Home</a></li>
  <li class="active">Active page</li>
</ol>
      <div class="row">
     <aside class="col-md-4">
     	<div class=" box_style_1 profile">
		<p class="text-center"><img src="img/teacher_2_small.jpg" alt="Teacher" class="img-circle styled"></p>
        		  <ul class="social_teacher">
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class=" icon-google"></i></a></li>
                </ul>   
                 <ul>
                     <li>Name <strong class="pull-right">Carla Twain</strong> </li>
                     <li>Email <strong class="pull-right">info@domain.com</strong></li>
                     <li>Telephone  <strong class="pull-right">+34 004238423</strong></li>
                     <li>Students <strong class="pull-right">42</strong></li>
                     <li>Lessons <strong class="pull-right">12</strong></li>
                     <li>Courses <strong class="pull-right">15</strong></li>
                </ul>
              
			</div><!-- End box-sidebar -->
     </aside><!-- End aside -->
     
     <div class="col-md-8">
     
     			<!--  Tabs -->   
                    <ul class="nav nav-tabs" id="mytabs">
                        <li class="active"><a href="#profile_teacher" data-toggle="tab">Profile</a></li>
                        <li><a href="#courses" data-toggle="tab">My Courses</a></li>
                    </ul>
                    
                     <div class="tab-content">
                    
                        <div class="tab-pane fade in active" id="profile_teacher">
                        <h3>About me</h3>
                        <p>Lorem ipsum dolor sit amet, dicta oportere ad est, ea eos partem neglegentur theophrastus. Esse voluptatum duo ne, expetenda corrumpit no per, at mei nobis lucilius. No eos semper aperiri neglegentur, vis noluisse quaestio no. Vix an nostro inimicus, qui ut animal fabellas reprehendunt. In quando repudiare intellegebat sed, nam suas dicta melius ea.</p>
                        <p>Mei ut decore accusam consequat, alii dignissim no usu. Phaedrum intellegat sit ut, no pri mutat eirmod. In eum iriure perpetua adolescens, pri dicunt prodesset et. Vis dicta postulant ad.</p>
                     	<h4>Credentials</h4>
						<p>Lorem ipsum dolor sit amet, dicta oportere ad est, ea eos partem neglegentur theophrastus. Esse voluptatum duo ne, expetenda corrumpit no per, at mei nobis lucilius. No eos semper aperiri neglegentur, vis noluisse quaestio no. Vix an nostro inimicus, qui ut animal fabellas reprehendunt. In quando repudiare intellegebat sed, nam suas dicta melius ea.</p>
						<div class="row">
                        	<div class="col-md-6">
                            	<ul class="list_3">
                                    <li><strong>September 2009 - Bachelor Degree in Economics</strong><p>University of Cambrige - United Kingdom</p></li>
                                    <li><strong>December 2012 - Master course in Economics</strong><p>University of Cambrige - United Kingdom</p></li>
                                    <li><strong>October 2013 - Master's Degree in Statistic</strong><p>University of Oxford - United Kingdom</p></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                            	<ul class="list_3">
                                    <li><strong>September 2009 - Bachelor Degree in Economics</strong><p>University of Cambrige - United Kingdom</p></li>
                                    <li><strong>December 2012 - Master course in Economics</strong><p>University of Cambrige - United Kingdom</p></li>
                                </ul>
                            </div>
                        </div><!-- End row--> 
                       </div><!-- End tab-pane --> 
                       
                       <div class="tab-pane fade in" id="courses">
                       			<h3>Active courses</h3>
                        		<p>Mei ut decore accusam consequat, alii dignissim no usu. Phaedrum intellegat sit ut, no pri mutat eirmod. In eum iriure perpetua adolescens, pri dicunt prodesset et. Vis dicta postulant ad.</p>
                                <div class="table-responsive">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Category</th>
                                        <th>Course name</th>
                                        <th>Lessons</th>
                                        <th>Rate</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Business</td>
                                        <td><a href="#">Business Plan</a></td>
                                        <td>12</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Economy pinciples</a></td>
                                        <td>12</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Understand diagrams</a></td>
                                        <td>04</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Marketing strategies</a></td>
                                        <td>10</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Marketing</a></td>
                                        <td>20</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Business Plan</a></td>
                                        <td>12</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></td>
                                      </tr>
                                      <tr>
                                        <td>Business</td>
                                        <td><a href="#">Economy pinciples</a></td>
                                        <td>12</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Understand diagrams</a></td>
                                        <td>04</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Marketing strategies</a></td>
                                        <td>10</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Marketing</a></td>
                                        <td>20</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i></td>
                                      </tr>
                                       <tr>
                                        <td>Business</td>
                                        <td><a href="#">Business Plan</a></td>
                                        <td>12</td>
                                        <td class="rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></td>
                                      </tr>
                                     
                                    </tbody>
                                  </table>
                                  </div>
                       </div><!-- End tab-pane -->
                       
                  </div>   <!-- End content-->              
		
     </div><!-- End col-md-8-->   	
  </div><!-- End row-->   
</div><!-- End container -->
</section><!-- End main_content-->

<section id="testimonials">
<div class="container">
	<div class="row">
		<div class='col-md-offset-2 col-md-8 text-center'>
			<h2>What they say</h2>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-offset-2 col-md-8'>
			<div class="carousel slide" data-ride="carousel" id="quote-carousel">
				<!-- Bottom Carousel Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#quote-carousel" data-slide-to="1"></li>
					<li data-target="#quote-carousel" data-slide-to="2"></li>
				</ol>
				<!-- Carousel Slides / Quotes -->
				<div class="carousel-inner">
					<!-- Quote 1 -->
					<div class="item active">
						<blockquote>
							<div class="row">
								<div class="col-sm-3 text-center">
									<img class="img-circle" src="img/testimonial_1.jpg" alt="">
								</div>
								<div class="col-sm-9">
									<p>
										Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!
									</p>
									<small>Someone famous</small>
								</div>
							</div>
						</blockquote>
					</div>
					<!-- Quote 2 -->
					<div class="item">
						<blockquote>
							<div class="row">
								<div class="col-sm-3 text-center">
									<img class="img-circle" src="img/testimonial_2.jpg" alt="">
								</div>
								<div class="col-sm-9">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor nec lacus ut tempor. Mauris.
									</p>
									<small>Someone famous</small>
								</div>
							</div>
						</blockquote>
					</div>
					<!-- Quote 3 -->
					<div class="item">
						<blockquote>
							<div class="row">
								<div class="col-sm-3 text-center">
									<img class="img-circle" src="img/testimonial_1.jpg" alt="">
								</div>
								<div class="col-sm-9">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum elit in arcu blandit, eget pretium nisl accumsan. Sed ultricies commodo tortor, eu pretium mauris.
									</p>
									<small>Someone famous</small>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>


        <?php get_footer(); ?>