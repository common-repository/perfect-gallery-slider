=== perfect gallery slider ===
Contributors: Hub Shoot1
Donate link: http://beautiful-module.com/demo/perfect-gallery-slider-2/
Tags:responsive perfect gallery slider,perfect gallery slider,mobile tuch image slider,responsive header gallery slider,header gallery slider,responsive banner slider,responsive header banner slider,header banner slider,responsive slideshow,slideshow,header image slideshow
Requires at least: 3.5
Tested up to: 4.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an Responsive header image slider OR Responsive perfect gallery slider inside wordpress page OR Template. Also mobile tuch perfect gallery slider

== Description ==

This plugin add a Responsive header perfect gallery slider in your website. Also you can add Responsive perfect gallery slider page and mobile tuch slider in to your wordpress website.

View [DEMO](http://beautiful-module.com/demo/perfect-gallery-slider-2/) for additional information.

= Installation help and support =
* Please check [Installation and Document](http://beautiful-module.com/documents/wordpress/perfect-gallery-slider.v.1.0.docx)  on our website.

The plugin adds a "Responsive header perfect gallery slider" tab to your admin menu, which allows you to enter Image Title, Content, Link and image items just as you would regular posts.

Also added 3 designs "Responsive perfect gallery slider-> Slider Designs". Select the design that you like and use shortcode. Also given complete shortcode.

To use this plugin just copy and past this code in to your header.php file or template file 
<code>
	<div class="headerslider">
	<?php echo do_shortcode('[sp_responsivegallery]'); ?>
	</div>
</code>

You can also use this perfect gallery slider inside your page with following shortcode 
<code>[sp_responsivegallery] </code>

If you want to select the design then you can use following parameter :
<code>[sp_responsivegallery design="design-1"] </code>
Where design: design-1, design-2, design-3

Display perfect gallery slider catagroies wise :
<code>[sp_responsivegallery cat_id="cat_id"]</code>
You can find this under  "Perfect gallery slider-> Gallery Category".

= Complete shortcode is =
<code>
[sp_responsivegallery design="design-1" cat_id="2" gallery_width="1024"
 gallery_height="300" slider_transition="fade" slider_transition_speed="300"
 gallery_autoplay="true" gallery_play_interval="3000" enable_fullscreen_button="true" enable_play_button="true"]
</code>
 
Parameters are :

* **limit** : [sp_responsivegallery limit="-1"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **design** : [sp_responsivegallery design="design-1"] (Display image slider with 3 designs. value is design-1, design-2, design-3)
* **cat_id** : [sp_responsivegallery cat_id="2"] (Display Image slider catagroies wise.) 
* **slider_transition** : [sp_responsivegallery slider_transition="slide"] (Image slider effect. value is "slide" OR "fade")
* **slider_transition_speed** : [sp_responsivegallery slider_transition_speed="3000"] (Set slider speed)
* **gallery_autoplay** : [sp_responsivegallery autoplay="true"] (Set autoplay or not. value is "true" OR "false")
* **gallery_play_interval** : [sp_responsivegallery autoplay_interval="3000"] (Set autoplay interval)

= Added new Features =
* 3 Design.
* Shortcode parameters. 
* Add custom link to image.
* Display muliple image slider on your website.
* Display Image slider catagroies wise   

= Features include: =
* Mobile tuch slide
* Responsive
* Shortcode <code>[sp_responsivegallery]</code>
* Php code for place image slider into your website header  <code><div class="headerslider"> <?php echo do_shortcode('[sp_responsivegallery]'); ?></div></code>
* Image slider inside your page with following shortcode <code>[sp_responsivegallery] </code>
* Easy to configure
* Smoothly integrates into any theme
* CSS and JS file for custmization

== Installation ==

1. Upload the 'perfect-gallery-slider' folder to the '/wp-content/plugins/' directory.
2. Activate the 'Perfect gallery slider' list plugin through the 'Plugins' menu in WordPress.
3. If you want to place perfect gallery slider into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[sp_responsivegallery limit="-1"]'); ?></div></code>
4. You can also display this perfect gallery slider inside your page with following shortcode <code>[sp_responsivegallery limit="-1"] </code>


== Frequently Asked Questions ==

= Are there shortcodes for perfect gallery slider items? =

If you want to place gallery slider into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[sp_responsivegallery limit="-1"]'); ?></div>  </code>

You can also display this perfect gallery slider inside your page with following shortcode <code>[sp_responsivegallery limit="-1"] </code>



== Screenshots ==

1. Design-1
2. Design-2
3. Design-3
4. Designs Views from admin side
5. Catagroies shortcode

== Changelog ==

= 1.0 =
Initial release