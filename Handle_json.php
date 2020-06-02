/**
     *  Algoritma get api request raja ongkir
     */
    $apiProvince = curl_init();
    curl_setopt_array($apiProvince, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 93f98424876fd5a0f171586476cafd71"
        ),
    ));
    // $response = curl_exec($apiProvince);
    // $err = curl_error($apiProvince);
    // curl_close($apiProvince);
    // if($err){
    //     echo "Error : " .$err;
    // } else {
    //     // echo $response;
    //     echo "<br>";
    // }
    // $data = json_decode($response);
    // $arrayResults = $data->rajaongkir->results;
    // foreach($arrayResults as $item){
    //     $city_id = $item->city_id;
    //     $id_province = $item->province_id;
    //     $city_name = $item->city_name;
    //     $postal_code = $item->postal_code;
    //     $queryInput = "INSERT INTO kota VALUES ('".$city_id."', '".$id_province."', '".$city_name."', '".$postal_code."')";
    //     $resultInput = $conn->query($queryInput);
    //     if($resultInput) continue;
    // }

    /**
     *  Algoritma get data request
     *  $data = json_decode($response);
     *  echo $data->rajaongkir->results[0]->province;
     *  $arrayProvince = $data->rajaongkir->results;
     *  foreach($arrayProvince as $item){
     *  $id_province = $item->province_id;
     *  $province_name = $item->province;
     *  $insertProvince = "INSERT INTO provinsi VALUES ('".$id_province."', '".$province_name."')";
     *  $resultInput = $conn->query($insertProvince);   
     *  if($resultInput){
     *  continue;
     *  }
     *  }
     */