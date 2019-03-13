# logclass
Class PHP to create, write and read a log file


<b>classe di log</b>

al costruttore possono essere inviati due valori auto espicativi:

<b>$log = new logger(["nomefiledilog"],[true|false] - visualizza a video o meno)</b>

è possibile non visualizzare o modificare il flusso di informazioni su singola riga, esempio:

<b>$log->write_log("messaggio che va nel file di log e viene visualizzato");</b>

<b>$log->write_log("messaggio che va nel file di log, ma non viene visualizzato",false);</b>
