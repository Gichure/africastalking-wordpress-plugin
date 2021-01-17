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

function patp_show_test_settings(){
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
        // variables for the field and option names
        echo 'Value '.$_POST['patp_test_settings_submit_hidden'];
        // Read in existing option value from database
        if( isset($_POST['patp_test_settings_submit_hidden']) && $_POST['patp_test_settings_submit_hidden'] == 'Y' ) {
            send_sms($_POST['test_settings_message'],$_POST['test_settings_recipient']);
     ?>
     <div class="updated">
     	<p><strong><?php _e('Sent successfully.', 'menu-test' ); ?></strong></p>
 	 </div>
     <?php 
        }
    ?>
	<div class="wrap">
    <h1>Send Message</h1>
    <form action="" method="POST">
    	<input type="hidden" name="patp_test_settings_submit_hidden" value="Y">
        <table class="form-table">
        	<tbody>
                <tr valign="top">
                	<th scope="row">Send To:</th><td><input type="text" placeholder="e.g. +254723461337" name="test_settings_recipient"/></td>
                </tr>
                <tr valign="top">
                	<th scope="row">Message:</th><td><input type="text" name="test_settings_message" required="required"/></td>
                </tr>
            </tbody>
        </table>
        <?php submit_button("Send","primary"); ?>
    </form>
</div>
<?php 
}
?>
