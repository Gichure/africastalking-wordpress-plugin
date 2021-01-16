<?php
    
    require __DIR__ . '/vendor/autoload.php';
    use AfricasTalkingGateway\AfricasTalkingGateway;
    
    /**
     * Plugin Name: AfricasTalking Gateway Plugin
     * Plugin URI: http://www.gichure.me.ke/paurush-sms-marketter-plugin
     * Description: A Wordpress Plugin to allow access to all AfricasTalking features from the Worpress Site
     * Version: 1.0
     * Author: Paul Gichure
     * Author URI: http://www.gichure.me.ke
     */
    
    function send_sms ( $message,$recipient) {
        $username = 'pgichure'; 
        $api_key   = 'YOUR_API_KEY'; 
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
        $username = 'pgichure'; 
        $api_key   = 'YOUR_API_KEY';
        $gateway = new AfricasTalkingGateway($username, $api_key);
        
        $amount = "KES ".$amount;
        $okFormat = json_encode(array(array("phoneNumber"=>$recipient,"amount"=>$amount)));
        try{
            $results = $gateway->sendAirtime($okFormat);
            
        }catch (AfricasTalkingGatewayException $e ){
            echo "Encountered an error while sending: ".$e->getMessage();
        }
        return $results;
    }
?>