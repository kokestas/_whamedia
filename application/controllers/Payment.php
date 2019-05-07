<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author Drager
 */
class Payment  extends CI_Controller {
    public function index() 
    {
        $this->load->view('payment');
    }
   
    public function charge()
    {
        $token = $this->input->post('stripeToken');
        
        
        $secret = 'sk_test_slezupO7CjZyXfjAFmEY8L0H';
        $error = '';
        $success = false;
        if (empty($token)) {
            $error = 'Token cant be empty.';
        } else {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges"); 
            curl_setopt($ch, CURLOPT_USERPWD, $secret.':'); 

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_POST, true); 
            curl_setopt($ch, CURLOPT_HEADER, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'amount' => "1500",
                'currency' => 'usd',
                'description' => 'Test charge',
                'source' => $token,
            ))); 

            $output = curl_exec($ch); 
            $file_name = $_SERVER['DOCUMENT_ROOT'].'/application/assets/payments_log.txt';

            file_put_contents($file_name, PHP_EOL.'Time:'.date('Y-m-d', time()). PHP_EOL.$output.PHP_EOL , FILE_APPEND | LOCK_EX);
            if(curl_errno($ch)){
                $error = 'Curl error: ' . curl_error($ch);
            }
            curl_close($ch);  
            $success = true;
        }
        
        $data = array(
            'error' => $error,
            'file_name' => $success,
        );
        $this->load->view('charge', $data, false);
    }
}
