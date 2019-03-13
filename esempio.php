<?php
//esempio.php

// includo la classe del logger
include('logclass.php');

// messaggio di test per il log
$msg = "Testo che va nel log per test.";

// creo nuova istanza del logger
$log = new logger();

// $log->app = false; // non visualizza il path ed il nome dell'applicazione chiamante

// invio messaggio al logger con visualizzazione
$log->write_log(__LINE__ . " " . $msg);

// invio messaggio al logger senza visualizzazione
$log->write_log(__LINE__ . " " . $msg,false);

// visualizzo il contenuto del file di log
$log->read_log();

//$log->read_log("/var/log/syslog"); // è possibile visualizzare tutti i file di cui si ha il permesso, meglio limitarsi ai file testo 

?>