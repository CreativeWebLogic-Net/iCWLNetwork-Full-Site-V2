<?php
    class clsGoogleSearch{

        function GetSearchQuery($search_str){
            
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://google-search72.p.rapidapi.com/search?q".$search_str."&gl=us&lr=lang_en&num=10&start=0",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: google-search72.p.rapidapi.com",
                        "X-RapidAPI-Key: 3dd050f002msh6d9fae15c1b67afp112871jsnb5f39e617b20"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                

                
                
                return $response;
        }

    }


?>