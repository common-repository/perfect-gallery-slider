<?phpthe_post_thumbnail(	array(120, 90), 	array(		'src' => wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ),		'data-image' => wp_get_attachment_url( get_post_thumbnail_id() ),		'alt' => the_title_attribute('echo=0'),		'data-description' => the_title_attribute('echo=0')	));?>