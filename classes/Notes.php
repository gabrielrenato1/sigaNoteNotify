<?php

namespace classes;

use utils\DataBase;

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
                'class_code'     => explode(',', $v)[0],
                'class_period'     => explode(',', $v)[2],
                'is_approved'   => (explode(',', $v)[3] == "Resources/checkTrue.png"),
                'average'      => explode(',', $v)[4],
                'absence'     => explode(',', $v)[6],
                'observation' => explode(',', $v)[7],
                'class_name'    => explode(',', $v)[1],
            ];

        }

        return $result;

    }

    public static function save($notes):void{

        $db = new Database;

        foreach ($notes as $note){
            $db->insert('notes', $note[0]);
        }

    }

}
