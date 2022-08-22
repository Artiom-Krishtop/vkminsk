<!-- start footer -->
    <?php global $themeum_options; ?>
	<?if( !is_front_page() || !get_queried_object_id() == 25757):?>
		<div class="container sponsors-carousel vc_column-inner ">
			<?if(get_locale()=="en_GB"):?>
					<div class="themeum-title"><div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 style="color:#000000;font-size:24px;margin-bottom:30px;padding:0px 0px 0px 0px;font-weight:700;"><span>Оur sponsors</span></h2></div>
				<?	 echo do_shortcode('[slide-anything id="11269"]'); ?>
			<?else:?>
				<div class="themeum-title"><div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 style="color:#000000;font-size:24px;margin-bottom:30px;padding:0px 0px 0px 0px;font-weight:700;"><span>Наши спонсоры</span></h2></div>
				<?	 echo do_shortcode('[slide-anything id="1839"]'); ?>
			<?endif;?>
		</div>
	<? endif;?>

<!-- Social footer -->

<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid count-box b-soc" style="opacity: 1; padding-right: 100px;padding-left: 100px; display: flex;" ><div class="wpb_column vc_column_container vc_col-sm-3" style="width: 25%;"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="soc__block soc__block--vk">
<div class="soc__item soc__back soc__vk"><a title="Следи за нами ВКонтакте" href="https://www.vk.com/vc.minsk" target="_blank" rel="noopener"><b>4966</b><span>подписчиков</span></a></div>
<div class="soc__item"><img class="alignnone size-full wp-image-16902" src="/wp-content/uploads/2019/08/logovk.png" alt="" width="103" height="60"></div>
</div>

</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3" style="width: 25%;"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="soc__block soc__block--fb">
<div class="soc__item soc__back soc__fb"><a title="Следи за нами на Facebook" href="https://www.facebook.com/vcminsk" target="_blank" rel="noopener"><b>715</b><span>подписчиков</span></a></div>
<div class="soc__item"><img class="alignnone size-full wp-image-16902" src="/wp-content/uploads/2019/08/logofb.png" alt="" width="40" height="85"></div>
</div>

</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3" style="width: 25%;"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="soc__block soc__block--inst">
<div class="soc__item soc__back soc__inst"><a title="Следи за нами на Instagram" href="https://www.instagram.com/vcminsk/" target="_blank" rel="noopener"><b>5649</b><span>подписчиков</span></a></div>
<div class="soc__item"><img class="alignnone size-full wp-image-16902" src="/wp-content/uploads/2019/08/logoinst.png" alt="" width="81" height="81"></div>
</div>

</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3" style="width: 25%;"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="soc__block soc__block--youtube">
<div class="soc__item soc__back soc__youtube"><a title="Смотри нас на YouTube" href="https://www.youtube.com/channel/UCPeTf0VbkGp2-6pJtZRlasA/videos" target="_blank" rel="noopener"><b>1610</b><span>подписчиков</span></a></div>
<div class="soc__item"><img class="alignnone size-full wp-image-16902" src="/wp-content/uploads/2019/08/logoyoutube.png" alt="" width="99" height="71"></div>
</div>

</div>
</div>
</div></div></div></div>

<!-- social footer -->

</div> <!-- #page -->

    <footer id="footer" class="footer-wrap">
    	<div class="footer__back-color"></div>
        <div class="footer-wrap-inner">
            <div class="container">
            	<div class="footer__circleleft"></div>
            	<div class="footer__circleright"></div>
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-12">
                        <div class="thm-footer-1-inner">
							<a class="navbar-brand" title="<?php echo get_bloginfo(); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php
								if (isset($themeum_options['logo']))
							   {
									
									if(!empty($themeum_options['logo'])) {
									?>
										<!--<img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="" title="">-->
										<img class="enter-logo img-responsive" src="/wp-content/themes/wpsoccer/images/logo-footer.png" alt="vcminsk" >
										
									<?php
									}else{
										echo esc_html(get_bloginfo('name'));
									}
									
									/*if($themeum_options['logo-text-en']) { ?>
										<span class="navbar-brand-title"> <?php echo $themeum_options['logo-text']; ?> </span>
									<?php }*/

							   }
								else
							   {
									echo esc_html(get_bloginfo('name'));
							   }
							?>
							</a>
							
							<?php dynamic_sidebar('Footer 1'); ?>							
                              
                        </div>            
                    </div>
					<div class="footer__menu col-md-3 col-sm-4 col-xs-12">
						<div class="col-sm-8 col-xs-12">
							<?php //dynamic_sidebar('Footer Title'); ?>   
						</div>
						<div class="col-md-12 col-sm-2 col-xs-3">
							<?php dynamic_sidebar('Footer 2'); ?>   
						</div>
						<div class="col-md-12 col-sm-2 col-xs-3">
							<?php dynamic_sidebar('Footer 3'); ?>
						</div> 
						<div class="col-md-12 col-sm-2 col-xs-3">
							<?php dynamic_sidebar('Footer 4'); ?>  
						</div> 
						<div class="col-md-12 col-sm-2 col-xs-3">
							<?php dynamic_sidebar('Footer 5'); ?>
							<!--<a class="tibo" target="_blank" title="Участник «Интернет-премии «ТИБО-2018»»" href="http://tibo.by/internet-premiya-tibo/"></a>-->
						</div>
						<div class="col-md-12 col-sm-2 col-xs-3">
							<?php dynamic_sidebar('Footer 6'); ?>
						</div>
					</div>
					<div class="b-footer-naw-wraper col-lg-4 col-sm-12 col-xs-12">
						<ul class="b-footer-nav-images">
							<li class="nav-images__item"><a href="<?= get_permalink(25474)?>" class="nav-images__link"><img src="/wp-content/themes/wpsoccer/images/ball.png" class="nav-images__img"></a></li>
							<li class="nav-images__item"><a href="<?= get_permalink(1386)?>" class="nav-images__link"><img src="/wp-content/themes/wpsoccer/images/human.png" class="nav-images__img"></a></li>
							<li class="nav-images__item"><a href="<?= get_permalink(12734)?>" class="nav-images__link"><img src="/wp-content/themes/wpsoccer/images/hands.png" class="nav-images__img"></a></li>
							<li class="nav-images__item"><a href="<?= get_permalink(17823)?>" class="nav-images__link"><img src="/wp-content/themes/wpsoccer/images/weight.png" class="nav-images__img"></a></li>
						</ul>
					</div>
                </div> <!-- end row -->

				<?php if (isset($themeum_options['copyright-en']) && $themeum_options['copyright-en']){?>
					<div class="copyright">
						<!-- <a class="tibo" target="_blank" title="Участник «Интернет-премии «ТИБО-2020»" href="http://tibo.by/ip/"></a> -->
						<?php if(isset($themeum_options['copyright-text'])) :?>
							<div class="wpb_column vc_column_container">
								<div class="vc_column-inner ">
									<?php echo balanceTags($themeum_options['copyright-text']); ?>
								</div>	
							</div>	
						<?endif;?>
						<div class="b-social-wrapper">
							<ul class="networks">
								<li><a href="https://vk.com/vc.minsk" target="_blank"><i class="fa fa-vk fa-3" aria-hidden="true"></i></a></li>
								<li><a href="https://www.facebook.com/vcminsk" target="_blank"><i class="fa fa-facebook fa-3" aria-hidden="true"></i></a></li>
								<li><a href="https://www.instagram.com/vcminsk/" target="_blank"><i class="fa fa-instagram fa-3" aria-hidden="true"></i></a></li>
								<li><a href="https://www.youtube.com/channel/UCPeTf0VbkGp2-6pJtZRlasA/videos" target="_blank"><i class="fa fa-youtube-play fa-3" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/vc_minsk" target="_blank"><i class="fa fa-twitter fa-3" aria-hidden="true"></i></a></li>
								<li><a href="https://t.me/vcminsk" target="_blank"><i class="fa fa-telegram fa-3" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<?if(get_locale()=="en_GB"):?>
							<div class="itgarant wpb_column vc_column_container">
								<div class="itg-soft span4">
									<span>
										<a class="itg-soft-order" href="https://itg-soft.by" target="_blank" title="">Website development</a> &nbsp;<a class="itg-soft-company" href="https://itg-soft.by" target="_blank" title="Website development in Minsk — ITG-SOFT.by">ITG-SOFT &lt;/&gt;</a>
									</span>
								</div>
							</div>							
						<?else:?>
							<div class="itgarant wpb_column vc_column_container">
								<div class="itg-soft span4 vc_column-inner ">
									<span>
										<a class="itg-soft-company" href="https://itg-soft.by" target="_blank" title="Разработка сайтов в Минске — ITG-SOFT.by">Разработка сайтов в Минске - </a> &nbsp;<!-- <a class="itg-soft-company" href="https://itg-soft.by" target="_blank" title="Разработка сайтов в Минске — ITG-SOFT.by"> -->ITG-SOFT &lt;/&gt;<!-- </a> -->
									</span>
								</div>
							</div>
						<?endif;?>
					</div>
				<?php } ?>  
				
            </div> <!-- end container -->
        </div> <!-- end footer-wrap-inner -->
    </footer>

<?php wp_footer(); ?>

<div class="social-button social-button-left" >
	<div class="ul owl-carousel owl-theme">
		<div class="li  item">
			<a class="tw" href="https://twitter.com/vc_minsk" target="_blank">
				<i class="fa fa-twitter" aria-hidden="true"></i>
			</a> 
		</div>
		<div class="li item">
			<a class="vk" href="https://vk.com/vc.minsk" target="_blank">
				<i class="fa fa-vk" aria-hidden="true"></i>
			</a> 
		</div>
		<div class="li item">
			<a class="facebook" href="https://www.facebook.com/vcminsk" target="_blank">
				<i class="fa fa-facebook" aria-hidden="true"></i>
			</a>
		</div>
		<div class="li item">
			<a class="yt" href="https://www.youtube.com/channel/UCPeTf0VbkGp2-6pJtZRlasA/videos" target="_blank">
				<i class="fa fa-youtube" aria-hidden="true"></i>
			</a> 
		</div>	
		<div class="li item">
			<a class="inst" href="https://www.instagram.com/vcminsk/" target="_blank">
				<i class="fa fa-instagram" aria-hidden="true"></i>
			</a> 
		</div>
	</div>
</div>

<?php if(isset($themeum_options['custom_js']) && !empty($themeum_options['custom_js'])): ?>
<script type="text/javascript">
    <?php print $themeum_options['custom_js']; ?>
</script>
<?php endif; ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter46569660 = new Ya.Metrika({
                    id:46569660,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/46569660" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>