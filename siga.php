<?php

use classes\Notes;
use utils\CurlRequest;

require './classes/Notes.php';
require './utils/CurlRequest.php';

$curl = new CurlRequest;

$sessionID = 'q4iu3i451jzcwlzcj2tnpdbf';

$historyNoteHtml = $curl->getHistoryNote($sessionID);


if(!empty($historyNoteHtml)){

    $notes = Notes::getNotesFromPage($historyNoteHtml);
    var_dump($notes);die;

}else{

    echo 'Não funcionou';
}



