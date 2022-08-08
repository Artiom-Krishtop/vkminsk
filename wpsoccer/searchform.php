<form role="form" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>" >
	<?
		use lloc\Msls\MslsBlogCollection; 
		$blog     = MslsBlogCollection::instance()->get_current_blog();
		$language = $blog->get_language();
	?>
 
	<?if($language=="en_GB"):?>
		   <input type="text" value="" name="s" id="s" class="form-control" placeholder="Search . . . . . . . . . . . . . . . ." autocomplete="off" />
	<?else:?>
		   <input type="text" value="" name="s" id="s" class="form-control" placeholder="" autocomplete="off" />
	<?endif;?>
	
    <i class="fa fa-search"></i>
</form>