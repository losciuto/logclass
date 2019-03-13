# logclass
Class PHP to create, write and read a log file


# classe di log

al costruttore possono essere inviati due valori auto espicativi:

# $log = new logger(["nomefiledilog"],[true|false] - visualizza a video o meno)

è possibile non visualizzare o modificare il flusso di informazioni su singola riga, esempio:

# $log->write_log("messaggio che va nel file di log e viene visualizzato");

# $log->write_log("messaggio che va nel file di log, ma non viene visualizzato",false);
