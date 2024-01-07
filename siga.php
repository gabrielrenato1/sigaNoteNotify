<?php

use classes\Notes;
use utils\CurlRequest;
use utils\DataBase;

require './classes/Notes.php';
require './utils/CurlRequest.php';
require './utils/DataBase.php';

$db = new Database;
$curl = new CurlRequest;

$sessionID = 'irqri355v3yyr445zwruqzj5';

$historyNoteHtml = $curl->getHistoryNote($sessionID);

if(!empty($historyNoteHtml)){

    $notes = Notes::getNotesFromPage($historyNoteHtml);

    $dbNotes = $db->list('notes', ['class_name', 'average', 'is_approved']);

    var_dump($dbNotes);die;

}else{

    echo 'Não funcionou';
}



