<?php
/**
 * Простая отправка писем.
 * По умолчанию использует PHP mail(). Если на сервере это не настроено — понадобится SMTP.
 */

function sendSiteMail($to, $subject, $htmlBody, $replyTo = null) {
    $to = trim((string)$to);
    if ($to === '') return false;

    $subject = trim((string)$subject);
    if ($subject === '') $subject = 'Website message';

    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';

    // From: стараемся поставить доменный адрес, но если неизвестно — используем no-reply@localhost
    $host = !empty($_SERVER['HTTP_HOST']) ? preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST']) : 'localhost';
    $fromEmail = 'no-reply@' . $host;
    $headers[] = 'From: ' . $fromEmail;

    if (!empty($replyTo)) {
        $replyTo = trim((string)$replyTo);
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    // mail() ожидает CRLF
    $headersStr = implode("\r\n", $headers);

    return @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $htmlBody, $headersStr);
}

