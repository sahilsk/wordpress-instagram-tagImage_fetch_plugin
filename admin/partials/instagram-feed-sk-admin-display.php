<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://sahilsk.github.io
 * @since      1.0.0
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
				
				<div id="icon-options-general" class="icon32"></div>
				<h2>Instagram Feed</h2>
				
				<?php if (empty($this->options['insta_apiKey']) || empty($this->options['insta_apiSecret']) || empty($this->options['insta_apiCallback']) || empty($this->options['insta_count'])) { ?>
					<div style="width:99%; padding: 5px;" class="error below-h2"><p>It doesn't look like there are any Instagram Client details saved yet, make sure to create a new Client in your Instagram account, <a href="http://instagram.com/developer/" target="_blank">do you want to create that now?</a></p></div>
				<?php } ?>

		
				
				<div id="poststuff">
				
					<div id="post-body" class="metabox-holder columns-2">
					
						<!-- main content -->
						<div id="post-body-content">
							
							<div class="tabs">
								<h2 class="nav-tab-wrapper">
									<a href="#tab1" class="nav-tab nav-tab-active">Settings</a>
							<!-- 		<a href="#tab3" class="nav-tab">Tab #2</a> -->
								</h2>
								
								<div id="tab1" class="tabs nav-tab-active">

									<div class="meta-box-sortables ui-sortable">
										
										<div class="postbox">
										
											<div class="inside">
									            <form method="post" action="options.php">
									            <?php
									                // This prints out all hidden setting fields
									                settings_fields( 'instagram_feed_sk_option_group' );   
									                do_settings_sections( 'instagram_feed_sk-setting-admin' );
									                submit_button(); 
									            ?>
									            </form>
											</div> <!-- .inside -->
										
										</div> <!-- .postbox -->
										
									</div> <!-- .meta-box-sortables .ui-sortable -->
									
								</div>
								
							</div>

							
						</div> <!-- post-body-content -->
						
						<!-- sidebar -->
						<div id="postbox-container-1" class="postbox-container">
							
							<div class="meta-box-sortables">
								
								<div class="postbox">
								
									<h3><span>What next?</span></h3>
									<div class="inside">

										<p>Once installed there are a couple of things you need to do to get things working.</p> 
										<ol>
											<li>Go to <a href="http://Instagram.com/developer/">http://Instagram.com/developer/</a> and click the button that says "Register Your Application"</li>
											<li>Fill in the details requested by Instagram, these will be thing like Application Name, Description, Website and redirect_uri (same as website will do).</li>
											<li>Once complete you will be given a CLIENT ID and a CLIENT SECRET.</li>
											<li>Now simply copy and paste the CLIENT ID, CLIENT SECRET and WEBSITE URI to this settings page .</li>
											<li>Save your settings then place shortcode `instalivit` eg. <br> [instalivit hashtag='tag1,tag2,tag3'] <br> in posts.</li>
											<li>Take some instagrams and hashtag them with the hashtag you setup in the settings and your feed will auto populate</li>
										</ol>
							           
									</div> <!-- .inside -->
									
								</div> <!-- .postbox -->
								
							</div> <!-- .meta-box-sortables -->
							
						</div> <!-- #postbox-container-1 .postbox-container -->
						
					</div> <!-- #post-body .metabox-holder .columns-2 -->
					
					<br class="clear">
				</div> <!-- #poststuff -->
				
			</div> <!-- .wrap -->