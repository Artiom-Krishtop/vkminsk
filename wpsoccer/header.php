<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="yandex-verification" content="07e4b1891825ecf0" />
	<meta name="google-site-verification" content="OrNKC_waumF2Mg-HuBX_ucacaYyQqYmvZeaKcQeJNls" />
	<meta name="cmsmagazine" content="ad40db880ba7cdaa13f8be1db6492541" />
	<meta http-equiv="Cache-Control" content="max-age=14400, must-revalidate" />
	<?php 
	if(isset($themeum_options['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri().'/images/plus.png'); ?>" type="image/x-icon"/>
	<?php } ?>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=cyrillic" rel="stylesheet">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="http://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.min.css"/>	
	<link rel="stylesheet" href="/wp-content/themes/wpsoccer-child/css/selectric.css"/>	
	<?php wp_head(); 
		wp_enqueue_style( 'font-awesome-4.7.0', get_template_directory_uri() . '/font-awesome-4.7.0/css/font-awesome.min.css');
		wp_enqueue_script( 'script', get_template_directory_uri() . '/js/circletype.min.js', array ( 'jquery' ), 1.1, true);
	?>
	<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="/wp-content/themes/wpsoccer-child/js/jquery.selectric.min.js"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-78415380-12"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-78415380-12');
	</script>

    <!-- bxslider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <!-- end bxslider -->
</head>

 <?php 

     if ( isset($themeum_options['boxfull-en']) ) {
      $layout = esc_attr($themeum_options['boxfull-en']);
     }else{
        $layout = 'fullwidth';
     }
 ?>

<body <?php body_class( $layout.'-bg' ); ?>>
	<div class="fixed-bg"></div>
	<div class="bg-image">
        <div class="bg__img bg__img--1"></div>
        <div class="bg__img bg__img--2"></div>
        <div class="bg__img bg__img--3"></div>
        <div class="bg__img bg__img--4"></div>
        <div class="bg__img bg__img--5"></div>
        <div class="bg__img bg__img--6"></div>
        <div class="bg__img bg__img--7"></div>
        <div class="bg__img bg__img--8"></div>
	</div>
	<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
		<header id="masthead" class="site-header header" role="banner">
			<div id="header-container">
				<div id="navigation" class="container">
                    <div class="row">

                        <div class="col-sm-12">
        					<div class="navbar-header">
        						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
                                <div class="logo-wrapper col-md-5">
        	                       <a class="navbar-brand"  title="<?php echo get_bloginfo(); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        		                    	<?php
        								
        										if($themeum_options['logo-text-en']) { ?>
        											<span class="navbar-brand-title"> <?php echo $themeum_options['logo-text']; ?> </span>
        										<?php }

        								?>
        		                     </a>
                                </div>    
					
        					</div>    
                        </div>

                        <div class="col-sm-12 woo-menu-item-add">
                            <?php 
                                global $woocommerce;
                                if($woocommerce) { ?>
                                    <span id="themeum-woo-cart" class="woo-cart" style="display:none;">
                                        
                                            <?php
                                                $has_products = '';
                                                //if($woocommerce->cart->cart_contents_count) {
                                                $has_products = 'cart-has-products';
                                                //}
                                            ?>
                                            <span class="woo-cart-items">
                                                <span class="<?php echo $has_products; ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                            </span>
                                            <i class="fa fa-shopping-cart"></i>
                                        
                                        <?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
                                    </span>
                                <?php } ?> 
								<?
									if (isset($themeum_options['logo']))
        								   {
        								   		
												if(!empty($themeum_options['logo'])) {
												?>
												<div class="col-md-2 logo">
													<a href="<?php echo get_home_url(); ?>"><img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="vcminsk" title=""></a></div>
													<?if(get_locale()=="en_GB"):?>
																<!-- <span class="slogan">Dream in heart</span>
																<span class="slogan">- strength in the game</span> -->
													<?else:?>
																<!-- <span class="slogan">Мечта в сердце</span>
																<span class="slogan">- сила в игре</span> -->
													<?endif;?>
													
													

												<?php
												}else{
													echo esc_html(get_bloginfo('name'));
												}
												
        										

        								   }
        									else
        								   {
        								    	echo esc_html(get_bloginfo('name'));
        								   }
								?>
								
                            <div id="main-menu" class="hidden-xs  col-md-7">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 0,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                ?>

                            </div>
                            <!--/#main-menu--> 


                            	<div class="col-md-3 home-search ">
									
									<?
									use lloc\Msls\MslsBlogCollection;
									$blog     = MslsBlogCollection::instance()->get_current_blog();
									//$language = $blog->get_language();
								
									?>
									<ul class="lang-swith">
										<li><a class="live"  href="/live" >Live</a></li>
										<?if($language=="en_GB"):?>	
											<li><a  href="/" >Ru</a></li>
										<?endif;?>
										<?if($language=="ru_RU"):?>
											<li><a  href="/en" >En</a></li>
										<?endif;?>
									</ul>
									<?php echo get_search_form();?>
								</div>	
                        </div>
                        
                        

                        <div id="mobile-menu" class="visible-xs">
                            <div class="collapse navbar-collapse">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'      => 'primary',
                                        'container'           => false,
                                        'menu_class'          => 'nav navbar-nav',
                                        'fallback_cb'         => 'wp_page_menu',
                                        'depth'               => 0,
                                        'walker'              => new wp_bootstrap_mobile_navwalker()
                                        )
                                    ); 
                                }
                                ?>
                            </div>
                        </div><!--/.#mobile-menu-->
                    </div><!--/.row--> 
				</div><!--/.container--> 
			</div>

		</header><!--/#header-->

        <?php/*
        if ( has_nav_menu( 'secondary_nav' ) )
        { ?>
        <div id="secondary-menu">
            <div class="secondary-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="secondary-menu">
                                <div class="navbar">

                                    <?php    $default = array( 'theme_location'  => 'secondary_nav',
                                                          'container'       => '', 
                                                          'menu_class'      => 'nav navbar-nav',
                                                          'menu_id'         => 'menu-secondary-menu',
                                                          'fallback_cb'     => 'wp_page_menu',
                                                          'depth'           => 2,
                                                          'walker'          => new wp_bootstrap_mobile_navwalker()
                                            ); 
                                        wp_nav_menu($default);

                                    ?>
                                </div><!--/.navbar--> 
                            </div><!--/.secondary-menu-->
                        </div><!--/.col-md-9-->
                      
                    </div><!--/.row-->
                </div><!--/.container-->
            </div> <!--/secondary-menu-wrap-->
        </div> <!--/#secondary-menu-->
        <?php }*/?>




        <!-- sign in form -->
        <div id="sign-form">
             <div id="sign-in" class="modal fade">
                <div class="modal-dialog modal-md">
                     <div class="modal-content">
                         <div class="modal-header">
                             <i class="fa fa-close close" data-dismiss="modal"></i>
                         </div>
                         <div class="modal-body text-center">
                             <h3><?php _e('Welcome','themeum'); ?></h3>
                             <form id="login" action="login" method="post">
                                <div class="login-error alert alert-info" role="alert"></div>
                                <input type="text"  id="username" name="username" class="form-control" placeholder="<?php _e('User Name','themeum'); ?>">
                                <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e('Password','themeum'); ?>">
                                <input type="submit" class="btn btn-default btn-block submit_button"  value="Login" name="submit">
                                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><strong><?php _e('Forgot password?','themeum'); ?></strong></a>
                                <p><?php _e('Not a member?','themeum'); ?> <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><strong><?php _e('Join today','themeum'); ?></strong></a></p>
                                <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                             </form>
                         </div>
                     </div>
                 </div> 
             </div>
        </div> <!-- end sign-in form -->
        <div id="logout-url" class="hidden"><?php echo esc_url(wp_logout_url( home_url() )); ?></div>
