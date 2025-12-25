<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

$clean = function ($key) {
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';
};

$name    = $clean('visitor_name');
$phone   = $clean('visitor_phone');
$mail    = $clean('visitor_mail');
$subject = $clean('visitor_subject');
$message = $clean('visitor_msg');

if ($mail) {
    $message_body  = "Imię i nazwisko: $name\n";
    $message_body .= "Telefon: $phone\n";
    $message_body .= "Adres email: $mail\n";
    $message_body .= "Temat: $subject\n\n";
    $message_body .= "Treść zgłoszenia:\n\n$message\n";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    if (mail("kontakt@przemekmiros.pl", "Formularz serwisowy", $message_body, $headers)) {
        $json = array("status" => 1, "msg" => "<p class='status_ok'>Twój formularz został wysłany. Niedługo otrzymasz odpowiedź</p>");
    } else {
        $json = array("status" => 0, "msg" => "<p class='status_err'>Wystąpił problem z wysłaniem formularza.</p>");
    }
} else {
    $json = array("status" => 0, "msg" => "<p class='status_err'>Proszę wypełnić wszystkie pola przed wysłaniem.</p>");
}

echo json_encode($json);
exit;
?>
