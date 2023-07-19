<?php

    try{

        $url = 'https://siga.cps.sp.gov.br/aluno/historicocompleto.aspx';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Cookie: ASP.NET_SessionId=gouu4pzl0jcjn52wed3p5r55"
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $var = (explode("\n", $response))[15];
        $var = explode('"TABLE1" class="Table"', $var)[1];
        $var = explode('<tr>', $var)[3];


        $string = $var;
        $ini = strpos($string, "value='");

        $ini += strlen("value='");
        $len = strpos($string, "'></td></tr>", $ini) - $ini;
        $var = substr($string, $ini, $len);


        $var = str_replace("[[", "", $var);
        $var = str_replace("]]", "", $var);
        $var = str_replace('"', "", $var);
        $var = explode('],[', $var);

        $result = array();

        foreach ($var as $index => $v){

            $result[$index][] = [
                'codigo'     => explode(',', $v)[0],
                'materia'    => explode(',', $v)[1],
                'media'      => explode(',', $v)[4],
                'frequencia' => explode(',', $v)[5],
                'faltas'     => explode(',', $v)[6],
                'aprovado'   => explode(',', $v)[3],
            ];

        }

        var_dump($result);

    }catch(Exception $e){

        echo "Usuário não autenticado";

    }

//var_dump($response);die;
