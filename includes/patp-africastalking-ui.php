<?php 


function patp_africastalking_settings(){ 
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    
    
    // variables for the field and option names
    $hidden_field_name = 'patp_settings_submit_hidden';
    
    // Read in existing option value from database
    $opt_val = get_option( $username_name );
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Save the posted value in the database
        update_option( 'patp_africastalking_username', $_POST[ 'patp_africastalking_username' ] );
        update_option( 'patp_africastalking_api_key', $_POST[ 'patp_africastalking_api_key' ] );
        update_option( 'patp_africastalking_sender_id', $_POST[ 'patp_africastalking_sender_id' ] );
        
        // Put a "settings saved" message on the screen
?>
<div class="updated"><p><strong><?php _e('Settings successfully saved.', 'menu-test' ); ?></strong></p></div>
<?php 
    }
?>
<div class="wrap">
    <h1>Paurush AfricasTalking Settings</h1>
    <form method="post" action="">
    	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    	<?php settings_fields( 'patp-africastalking-settings' ); ?>
    	<?php do_settings_sections( 'patp-fricastalking-settings' ); ?>
        <table class="form-table">
            <tr valign="top">
            	<th scope="row">AfricasTalking Username:</th><td><input type="text" name="patp_africastalking_username" value="<?php echo get_option( 'patp_africastalking_username' ); ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row">AfricasTalking API Key:</th><td><input type="password" name="patp_africastalking_api_key" value="<?php echo get_option( 'patp_africastalking_api_key' ); ?>"/></td>
            </tr>
            <tr valign="top">
            	<th scope="row">AfricasTalking Sender ID:</th><td><input type="text" name="patp_africastalking_sender_id" value="<?php echo get_option( 'patp_africastalking_sender_id' ); ?>"/></td>
            </tr>
        </table>
    	<?php submit_button(); ?>
    </form>
</div>
<?php 
}

function patp_show_directory(){
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    ?>
	<div class="wrap">
    <h1>Directory</h1>
        <table class="form-table">
        	<th>
        		<td>Name</td>
        		<td>Phone Number</td>
        	</th>
        	<tbody>
                <tr valign="top">
                	<th scope="row">AfricasTalking Username:</th><td><input type="text" name="username" value="<?php echo get_option( 'username' ); ?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">AfricasTalking API Key:</th><td><input type="password" name="api_key" value="<?php echo get_option( 'api_key' ); ?>"/></td>
                </tr>
                <tr valign="top">
                	<th scope="row">AfricasTalking Sender ID:</th><td><input type="text" name="sender_id" value="<?php echo get_option( 'sender_id' ); ?>"/></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php 
}

// mt_settings_page() displays the page content for the Test Settings submenu
function mt_settings_page() {
    
    //must check that the user has the required capability
    if (!current_user_can('manage_options'))
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    
    // variables for the field and option names
    $opt_name = 'mt_favorite_color';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'mt_favorite_color';
    
    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        
        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        
        // Put a "settings saved" message on the screen
        
        ?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Menu Test Plugin Settings', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Favorite Color:", 'menu-test' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>
<?php 
}
?>
