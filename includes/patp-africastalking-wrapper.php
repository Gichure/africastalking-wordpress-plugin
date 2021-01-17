<?php 
    /*
     * Abstract AfricasTalking API calls
    */
require_once('AfricasTalkingGateway.php');

function send_sms ($message,$recipient) {
    $username =  get_option( 'patp_africastalking_username' );
    $api_key   =  get_option( 'patp_africastalking_api_key' );
    $sender_id   =  get_option( 'patp_africastalking_sender_id' );
    $gateway = new AfricasTalkingGateway($username, $api_key);
    
    try{
        
        $results = $gateway->sendMessage($recipient, $message);
        
        foreach( $results as $result ) {
            // status is either "Success" or "error message"
            echo " Number: " .$result->number;
            echo " Status: " .$result->status;
            echo " MessageId: " .$result->messageId;
            echo " Cost: "   .$result->cost."\n";
        }
    }catch (AfricasTalkingGatewayException $e ){
        echo "Encountered an error while sending: ".$e->getMessage();
    }
    
}

function send_airtime($amount, $recipient) {
    $username =  get_option( 'patp_africastalking_username' );
    $api_key   =  get_option( 'patp_africastalking_api_key' );
    $sender_id   =  get_option( 'patp_africastalking_sender_id' );
    $gateway = new AfricasTalkingGateway($username, $api_key);
    
    $amount = "KES ".$amount;
    $okFormat = json_encode(array(array("phoneNumber"=>$recipient,"amount"=>$amount)));
    try{
        $results = $gateway->sendAirtime($okFormat);
        echo $results;
    }catch (AfricasTalkingGatewayException $e ){
        echo "Encountered an error while sending: ".$e->getMessage();
    }
}

?>