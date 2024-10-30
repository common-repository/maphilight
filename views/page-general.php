<?php

$options = Map_Hilight::getOptions();

?>
<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->	
		
<div class="wrap">
	
	<div id="icon-themes" class="icon32"><br /></div>

	<h2><?php echo esc_html(__('Configuration - Map Hilight', 'map_hilight')); ?></h2>
	
	<!-- If we have any error by submiting the form, they will appear here -->
	<?php settings_errors( 'map-hilight-settings-errors' ); ?>
	
	<p><?php _e('MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive. Based on the maphilight jQuery plugin, MapHilight allows you to customize a hover effect on your maps or images.', 'map-hilight'); ?></p>

	<p><?php _e('Use it in your Posts by adding the following shortcode : [maphilight]', 'map-hilight'); ?></p>

	<form id="form-map-hilight-options" action="" method="post" enctype="multipart/form-data">
		<?php wp_nonce_field('map_hilight_update_options', Map_Hilight::NONCE_NAME); ?>

		<p><?php _e( 'Upload an image for your map.', 'map-hilight' ); ?></p>
		<input type="hidden" id="logo_url" name="map_hilight_options[map_url]" value="<?php echo esc_url( $options['map_url'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload a map', 'map-hilight' ); ?>" />
		<?php if ( '' != $options['map_url'] ): ?>
			<input id="delete_logo_button" name="map_hilight_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Map', 'map-hilight' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the map.', 'map-hilight' ); ?></span>
		<div id="upload_logo_preview" style="min-height: 100px;">
			<img style="max-width:100%;" src="<?php echo esc_url( $options['map_url'] ); ?>" />
		</div>
		<table class="form-table">
			<tr valign="top"><th scope="row"><?php _e( 'Map Areas Code', 'map-hilight' ); ?></th>
				<td>
					<textarea id="map_hilight_options_textarea" class="large-text" cols="50" rows="10" name="map_hilight_options_textarea"><?php echo esc_textarea( $options['map_area_code'] ); ?></textarea>
					<label class="description" for="map_hilight_options_textarea"><?php _e( 'Paste inside the textarea the &lt;area&gt; tags (no &lt;map&gt; tag !) that you may have created using Fireworks.', 'map-hilight' ); ?></label>
				</td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e( 'Border Color', 'map-hilight' ); ?></th>
				<td>
					<input id="map_hilight_options[border_color]" class="regular-text" type="text" name="map_hilight_options[border_color]" value="<?php esc_attr_e( $options['border_color'] ); ?>" />
					<label class="description" for="map_hilight_options[border_color]"><?php _e( 'Fill in with the color\'s 6 digits only (No #).', 'map-hilight' ); ?></label>
				</td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e( 'Background Color', 'map-hilight' ); ?></th>
				<td>
					<input id="map_hilight_options[background_color]" class="regular-text" type="text" name="map_hilight_options[background_color]" value="<?php esc_attr_e( $options['background_color'] ); ?>" />
					<label class="description" for="map_hilight_options[background_color]"><?php _e( 'Fill in with the color\'s 6 digits only (No #).', 'map-hilight' ); ?></label>
				</td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e( 'Background Opacity', 'map-hilight' ); ?></th>
				<td>
					<input id="map_hilight_options[opacity]" class="regular-text" type="text" name="map_hilight_options[opacity]" value="<?php esc_attr_e( $options['opacity'] ); ?>" />
					<label class="description" for="map_hilight_options[opacity]"><?php _e( 'Fill in with an opacity number from 0.1 to 1.', 'map-hilight' ); ?></label>
				</td>
			</tr>
		</table>
		<input type="hidden" name="map_hilight_action" value="update" />
		<p class="submit">
			<input name="map_hilight_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'map-hilight'); ?>" />
			<input name="map_hilight_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'map-hilight'); ?>" />		
		</p>
	
	</form>
	
</div>
