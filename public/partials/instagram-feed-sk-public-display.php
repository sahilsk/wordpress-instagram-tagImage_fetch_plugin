<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://sahilsk.github.io
 * @since      1.0.0
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/public/partials
 */


//<!-- This file should primarily consist of HTML with a little bit of PHP. -->

			
	//echo "<div class=\"insta_feed_sk_wrapper js-masonry\" data-masonry-options='{ \"columnWidth\": 200, \"itemSelector\": \".insta_feed_single_sk\" }' >";
	echo "<div class=\"insta_feed_sk_wrapper\" >";
		$count = 0;
		echo '<div class="grid-sizer"></div>';
	    foreach ($images as $image) {
	    	if ($count == $media_count) continue;
	    	echo '<div class="insta_feed_single_sk ' ;
	    	if( $count%2 == 0){
	    		echo ' w2';
	    	}
	    	echo '" ';
//			echo ' style="width:';
//			echo mt_rand(33,  75) ;
			echo '%;"';
			echo '  ><a href="#" data-featherlight="'.$image.'"  ><img src="'.$image.'" /> </a>
				</div>';
			$count++;
	    }

	echo '</div>';

// Make container for popup item
	echo "<div class='insta_feed_sk_popup shadow'> ";
		echo "<a href='#' class='close' style='display: block; position: absolute; top:0; right:0; z-index:12'> &cross; </a>";
		echo "<div class='insta_feed_sk_img_wrapper'> </div>";
		echo "<div class='insta_feed_img_rating'></div>";
		echo "<!--<span>  </span>";
		echo "<ul class='insta_feed_sk_img_comments'></ul>-->";
	echo "</div>";