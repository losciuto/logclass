<?php
//logclass.php
//
// classe di log
// al costruttore possono essere inviati due valori auto espicativi:
// $log = new logger(["nomefiledilog"],[true|false] - visualizza a video o meno)
//

class logger
{

    public $file        = 'logfile.log';    // nome del file
    public $log_file    = '';               // path + file
    public $app         = true;             // include path + nome appa chiamante nel rocord di log
    public $visua       = true;             // visualizza il record di log a video

    private $dir        = './log/';         // sotto directory per il file di log
    private $write      = true;             // scrive o meno il record di log sul file o lo invia al syslog di sistema

    // metodo di costruzione della classe
    public function __construct($file = "",$visua=true)
    {
        $this->visua = $visua;

        // modifica in fase di costruzione il file di log e relativa cartella
        if (trim($file) != "") {

            $this->file = $file; // riassegno la variabile 

        }

        $this->log_file = $this->dir . $this->file;

        // controlla la presenza della directory
        if (!is_dir($this->dir)) {

            // se non esiste la directory
            if (!mkdir($this->dir, 0755, true)) { // provo a crearla

                $this->write = false; // se non ci riesco non permetto la scrittura del record di log
                return;

            }

        } 

        if(!is_writable($this->log_file)) { // controllo la scrivibilità del file (controlla anche se esiste)

            if (!file_put_contents($this->log_file, "[" . date('d/m/Y H:i:s') . "] inizio\n")) { // provo ad inizializzare il file di log

                $this->write = false; // se non ci riesco, allora non permetto la scrittura del file di log

            }

        }

    }

    // metodo di scrittura del record di log
    public function write_log($msg)
    {

        // composizione del record di log

        // se impostata a vero (default) la variabile $this->applicazione, allora aggiunge il path ed il file al messaggio
        if ($this->app) $msg = __FILE__ . " " . $msg;

        // il record di log
        $logrec = "["  . date('d/m/Y H:i:s') . "] " . $msg . "\n";

        // se possibile la scrittura del file
        if ($this->write) {

            // scrivo il record di log
            error_log($logrec, 3, $this->log_file);

            // visualizzo a video (default) il record di log
            if($this->visua) echo $logrec;

        } else { // se non è possibile creare la directory log e non è possibile scrivere sul file di log, allora rimanda il record log come errore al syslog di sistema

            $errmsg = "permessi di scrittura insufficienti per il file di log. " . $logrec; // ridefinizione del record di log

            // invio a syslog di sistema del messaggio di errore
            openlog("[PHP-classe-tolog]", LOG_PID, LOG_USER);
            syslog(LOG_ERR, $errmsg);
            closelog();

            // visualizzazione del record log e della segnalazione di mancata memorizzazione sul file
            echo "\n" . $errmsg;
            echo "\nlog non scrivibile o non utilizzabile (permesso negato)\n";

        }

    }

    // metodo di lettura di un file di log (o, eventualmente di un qualsiasi file di testo)
    public function read_log($log_file = "")
    {

        echo "\n\n";

        if (trim($log_file) != "") {

            $this->log_file = $log_file; // ridefinisco il path + nome del file

        }

        if (is_file($this->log_file)) { // se esiste il file indicato

            echo file_get_contents($this->log_file); // visualizzo il file di log

        } else { // se non esiste allora...

            echo "non posso visualizzare il file di log richiesto: " . $this->log_file . "\n\n"; // visualizzo la nota di impossibilità

        }

    }

}

?>
 