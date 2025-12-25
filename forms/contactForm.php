<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

// Pobierz dane z formularza, upewnij się, że są zabezpieczone
$name = isset($_POST['form-name']) ? htmlspecialchars($_POST['form-name']) : "";
$phone = isset($_POST['form-phone']) ? htmlspecialchars($_POST['form-phone']) : "";
$mail = isset($_POST['form-mail']) ? htmlspecialchars($_POST['form-mail']) : "";
$company = isset($_POST['form-company']) ? htmlspecialchars($_POST['form-company']) : "";
$subject = isset($_POST['form-service']) ? htmlspecialchars($_POST['form-service']) : "";
$message = isset($_POST['form-msg']) ? htmlspecialchars($_POST['form-msg']) : "";

if ($mail) {
    // Utwórz treść wiadomości
    $message_body = "Imię i nazwisko: $name\n";
    $message_body .= "Adres email: $mail\n\n";
    $message_body.= "Treść wiadomości:\n\n";
    $message_body .= "$message\n";

    // Ustaw nagłówki
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    // Spróbuj wysłać e-mail
    if (mail("kontakt@przemekmiros.pl", "Formularz kontaktowy", $message_body, $headers)) {
        $json = array("status" => 1, "msg" => "<p class='status_ok'>Twój formularz został wysłany. Niedługo otrzymasz odpowiedź</p>");
    } else {
        $json = array("status" => 0, "msg" => "<p class='status_err'>Wystąpił problem z wysłaniem formularza.</p>");
    }
} else {
    $json = array("status" => 0, "msg" => "<p class='status_err'>Proszę wypełnić wszystkie pola przed wysłaniem.</p>");
}

echo json_encode($json);
exit;
