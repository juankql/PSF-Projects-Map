<script>
	jQuery(function($){
		$('.color_field').each(function(){
        	$(this).wpColorPicker();
    	});
	});
</script>
<div class="wrap">
	<h2 style="text-align:center;padding-bottom:15px;">PSF Map Manager Plugin Configuration</h2>
	<form action="options.php" method="post" enctype="multipart/form-data">
	<?php
 		settings_fields('pwpsf_map_manager-settings');
	?> 
		<table class="form-table">
			<tr>
				<th scope="row"><label for="google_maps_api_key"><?php _e('Key to use Google Maps API','pwpsf-map-manager') ?></label></th>
				<td><input type="text" name="google_maps_api_key" id="google_maps_api_key" placeholder="<?php _e('Key to use Google Maps API','pwpsf-map-manager') ?>" value="<?php echo esc_attr(get_option('google_maps_api_key')); ?>" style="width:100%;" ></td>
			</tr>
		</table>
		<?php 
		do_settings_sections('pwpsf_map_manager-settings'); 
		submit_button();?>
	</form>
</div>