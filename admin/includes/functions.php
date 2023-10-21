<?php 
function generateUniqueOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $otp;
}
function input_filter($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
function ApiCalling()
{
    $curl = curl_init();
    $user_agent = 'YourApp/1.0';
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=aab4705b729e4d08bf639a337a501aee',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'User-Agent: ' . $user_agent
      ),
    ));
    
    $response = curl_exec($curl);
    
    $data = json_decode($response, true);
    curl_close($curl);
    return $data;
    

}

