<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tvoja emailová adresa
    $to = "info@hitaesstudio.sk";
    
    // Získanie údajov z formulára
    $name = strip_tags(trim($_POST["Meno"]));
    $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
    $service = strip_tags(trim($_POST["Služba"]));
    $message = strip_tags(trim($_POST["Poznámka"]));

    // Predmet emailu
    $subject = "Nový dopyt z webu: " . $service;

    // Obsah emailu
    $email_content = "Meno: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Služba: $service\n\n";
    $email_content .= "Správa:\n$message\n";

    // Hlavičky emailu (aby to neskončilo v spame na Websupporte)
    $headers = "From: Hitaes Studio <info@hitaesstudio.sk>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Odoslanie emailu
    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Ďakujeme! Váš dopyt bol úspešne odoslaný.";
    } else {
        http_response_code(500);
        echo "Ups! Niečo sa nepodarilo a správu sme nemohli odoslať.";
    }

} else {
    http_response_code(403);
    echo "Pri odosielaní nastala chyba.";
}
?>
