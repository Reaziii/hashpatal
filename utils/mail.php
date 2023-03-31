<?php

function sendMail($to, $subject, $body)
{
    $toName = 'Hello';
    $toEmail = $to;
    $fromName = 'Hashpatal';
    $fromEmail = 'admin@hashpatal.com';
    $subject = $subject;
    $htmlMessage = $body;
    $data = array(
        "sender" => array(
            "email" => $fromEmail,
            "name" => $fromName
        ),
        "to" => array(
            array(
                "email" => $toEmail,
                "name" => $toName
            )
        ),
        "subject" => $subject,
        "htmlContent" => '<html><head></head><body><p>' . $htmlMessage . '</p></p></body></html>'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Api-Key: ' . sendinblueapi;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);
}
