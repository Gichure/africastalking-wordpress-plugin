<?php 
$patp_table_prefix=$wpdb->prefix;
define('PATP_TABLE_PREFIX', $patp_table_prefix);

//****If plugin is active**************************************
register_activation_hook(__FILE__,'patp_plugin_install');
register_deactivation_hook(__FILE__ ,'patp_plugin_uninstall');

//function will call when plugin will active
function patp_plugin_install()
{
    global $wpdb;
    $table_name = $wpdb->prefix."patp_settings";
    $structure = "CREATE TABLE $table_name (
		        id INT(9) NOT NULL AUTO_INCREMENT,
		        user_name VARCHAR(20) NOT NULL,
                api_key VARCHAR(32) NOT NULL,
		        PRIMARY KEY id (id)
		    );";
    $wpdb->query($structure);
}

//function will call when plugin will deactive
function patp_plugin_uninstall(){
    global $wpdb;
    $table = MOB_TABLE_PREFIX."patp_settings";
    $structure = "drop table if exists $table";
    $wpdb->query($structure);
}

?>