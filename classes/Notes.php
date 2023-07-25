<?php

namespace classes;

class Notes
{

    public static function getNotesFromPage($historyNoteHtml):array{


        $var = (explode("\n", $historyNoteHtml))[15];
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

        return $result;

    }

}