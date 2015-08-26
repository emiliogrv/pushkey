<?php namespace Emiliogrv\PushKey;

class PushKey {

    private function GCM($priority, $multiple, $registration_id, $message, $title, $msgcnt){
	   /*--- Enviando notificaciones push ----*/
        // variable post http://developer.android.com/google/gcm/http.html#auth
        $url = 'https://gcm-http.googleapis.com/gcm/send';
 		if($multiple){
	        $fields = array(
				'registration_ids' => $registration_id,//array
				'data' => array(
							'message'  => $message,
							'title'    => $title,
							'msgcnt'   => $msgcnt,
							'priority' => $priority,
							)
	        );
    	}
        else{
	        $fields = array(
				'to'   => $registration_id,//unique
				'data' => array(
							'message'  => $message,
							'title'    => $title,
							'msgcnt'   => $msgcnt,
							'priority' => $priority,
							)
	        );
        }
 
        $headers = array(
            'Authorization: key=' . env('GOOGLE_API_KEY'),
            'Content-Type: application/json'
        );
        // abriendo la conexion
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Deshabilitamos soporte de certificado SSL temporalmente
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // ejecutamos el post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Cerramos la conexion
        curl_close($ch);
        //echo $result;
	}

    public function sendMessage($priority = 'normal', $multiple = false, $platform = null, $key, $message = 'WekNock with you', $title = 'WekNock Notification', $msgcnt = '0'){
		if($platform){
			if($key){
				if($platform == 'android' || $platform == 'amazon-fireos')
					$this->GCM($priority, $multiple, $key, $message, $title, $msgcnt);
			}
		}
	    //$result = send_notification($registatoin_ids, $message);//array
	    //$result = send_notification($gcm_regid, $message);//unique
	}

    public function register($platform = null, $key){
		if($platform){
			if($key){
				if($platform == 'android' || $platform == 'amazon-fireos')
					$this->GCM('normal', false, $key, '_Login_Successfully_In_WekNock', '_LOGGED' ,'1');
			}
		}
	}

    public function logout($platform = null, $key){
		if($platform){
			if($key){
				if($platform == 'android' || $platform == 'amazon-fireos')
					$this->GCM('normal', false, $key, '_Logoff_Successfully_Of_WekNock', '_LOG_OUT' ,'1');
			}
		}
	}

    public function hola(){
		echo "Hello World";
	}

}