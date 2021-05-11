<?php // inserisci qui il tuo indirizzo email 
$receiverMail = “rppsoundofficial@gmail.com“; 
// pulizia dei dati inseriti 
$name = ltrim(rtrim(strip_tags(stripslashes($_POST[‘name’])))); 
$email = ltrim(rtrim(strip_tags(stripslashes($_POST[‘email’])))); 
$subject = ltrim(rtrim(strip_tags(stripslashes($_POST[‘subject’]))));
 $msg = ltrim(rtrim(strip_tags($_POST[‘msg’])));
  // lettura dell’indirizzo IP 

$ip = getenv(“REMOTE_ADDR”); 
// formattazione del messaggio ( \n per le messe a capo ) 
$msgformat = “Messaggio da: $name ($ip)\nEmail: $email\n\n$msg”; 
// verifica campi obbligatori 
if(empty($name) || empty($email) || empty($subject) || empty($msg)) { 
    echo “<h3>Il messaggio non è stato inviato</h3><p>Compila tutti i campi obbligatori!</p>”; 
}  
// verifica indirizzo email 
elseif(!ereg(“^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$”, $email)) { 
    echo “<h3>Il messaggio non è stato inviato</h3><p>L’indirizzo email indicato non è valido!</p>”; 
} 
else { 
    // invio del messaggio 
    mail($receiverMail, $subject, $msgformat, “From: $name <$email>”); 
    echo “<h3>Il messaggio e’ stato inviato!</h3><p>Riceverai una risposta il prima possibile!</p>”; }
    ?>