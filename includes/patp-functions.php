<?php 

    global $patp_db_version;
    $patp_db_version = '1.0';
    
    include_once 'patp-africastalking-ui.php';
    include_once 'patp-user-details.php';
    
    /*
     * Add AfricasTalking Settings menu to the Admin Control Panel
     */

    //****If plugin is active**************************************
    register_activation_hook(__FILE__,'patp_plugin_install');
    register_deactivation_hook(__FILE__ ,'patp_plugin_uninstall');
    
    //function will call when plugin will active
    function patp_plugin_install()
    {
        global $wpdb;
        global $patp_db_version;
        $installed_db_ver = get_option("patp_db_version");
        if ( $installed_db_ver != $patp_db_version ) {
            $table_name = $wpdb->prefix."patp_settings";
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              user_name tinytext NOT NULL,
              api_key tinytext NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            update_option( "patp_db_version", $patp_db_version );
        }
    }
    
    //DB check and upgrade on plugin upgrade
    function patp_plugin_update_db_check() {
        global $patp_db_version;
        if ( get_site_option( 'patp_db_version' ) != $patp_db_version) {
            patp_plugin_install();
        }
    }

    //function will call when plugin will be unistalled
    function patp_plugin_uninstall(){
        global $wpdb;
        $table = MOB_TABLE_PREFIX."patp_settings";
        $structure = "drop table if exists $table";
        $wpdb->query($structure);
    }
    
    // Add the 'admin_menu' action hook, run the function named 'patp_add_africastalking_settings_link()'
    add_action( 'admin_menu', 'patp_add_africastalking_settings_link' );
    
    // Add a new top level menu link to the ACP
    function patp_add_africastalking_settings_link(){
        
        $page_title = 'Paurush AfricasTalking Settings';
        $menu_title = 'PAT Settings';
        $test_settings_menu_title = 'Send Message';
        $capability = 'manage_options';
        $menu_slug = 'patp-africastalking-settings';
        $test_settings_menu_slug = 'patp-test-settings';
        $function = 'patp_africastalking_settings';
        $test_settings_menu_function = 'patp_show_test_settings';
        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function);
        add_submenu_page($menu_slug, $page_title, $test_settings_menu_title, $capability, $test_settings_menu_slug, $test_settings_menu_function);
    }
    
?>