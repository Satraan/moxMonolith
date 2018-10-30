<?php

$email = new \SendGrid\Mail\Mail();
$email->setFrom("mandiasamuels@gmail.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("mandiasamuels@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}

