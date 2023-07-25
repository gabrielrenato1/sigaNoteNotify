<?php

// include "vendor/autoload.php";

namespace utils;

class CurlRequest
{

    public function login(){


    }
    public function getHistoryNote($sessionId):string{

        $url = 'https://siga.cps.sp.gov.br/aluno/historicocompleto.aspx';

        $header = [
            "Content-Type: application/json",
            "Cookie: ASP.NET_SessionId=".$sessionId
        ];

        return $this->sendRequest($url, 'GET', $header);

    }
    private function sendRequest($url, $method, $header):string{

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $header,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }
}