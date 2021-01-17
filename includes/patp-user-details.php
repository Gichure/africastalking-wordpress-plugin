<?php 


/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function wporg_usermeta_form_field_phone_number_update( $user_id )
{
    // check that the current user have the capability to edit the $user_id
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    
    // create/update user meta for the $user_id
    return update_user_meta(
        $user_id,
        'phone_number',
        $_POST['phone_number']
        );
}
// Add the field to user's own profile editing screen.
add_action(
    'show_user_profile',
    'wporg_usermeta_form_field_phone_number'
    );

// Add the field to user profile editing screen.
add_action(
    'edit_user_profile',
    'wporg_usermeta_form_field_phone_number'
    );

// Add the save action to user's own profile editing screen update.
add_action(
    'personal_options_update',
    'wporg_usermeta_form_field_phone_number'
    );

// Add the save action to user profile editing screen update.
add_action(
    'edit_user_profile_update',
    'wporg_usermeta_form_field_phone_number'
    );
?>