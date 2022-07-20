<?php
error_reporting(0);
ini_set('display_errors', 0);


try {
   if (isset($_GET["number"])){
    $number = $_GET["number"];
   
    $lastNumber = $number;

    $url = 'https://rdod.live/contacts_api/api.php?getName=true&phone='.$lastNumber;

    
    $header = [
        "UserAgent: Example REST API Clint"
    ];
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept-Encoding: text/plain'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$remArray = json_decode($response, true);

if (is_null($remArray['data'])){

    

    $url = 'http://nbrpro.me/nbrpro_handler/search/s_n_1?devuid=D1BF72E3-AE3A-4777-8464-A6AB695C1310&fcntry=+966&nid='.$lastNumber;

$response = file_get_contents($url);

$remArray = json_decode($response, true);
$ndeco = $remArray['t'];


    $onlyNames = array();
        foreach ($ndeco as $name){
            
            array_push($onlyNames, $name[Name]);
        }
           
            echo json_encode($onlyNames, true);

} else {
   
    $ndeco = $remArray['data'];
    $onlyNames = array();
        foreach ($ndeco as $name){
            
            array_push($onlyNames, $name[name]);
        }
    
    echo json_encode($onlyNames, true);
}


   } else {
    echo 'ERROR NOT ADD NUMBER';
   }
   
}
catch(Exception $e){
    echo "Error";
    echo $e->getMessage;
}

?>


