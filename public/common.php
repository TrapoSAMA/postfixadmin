<?php

require_once(dirname(__FILE__) . '/../common.php');

set_exception_handler(function ($exception) {

    // we could do something much better here - e.g. if the user is logged in, and an admin, show a full stack trace etc.
    if ($exception instanceof CsrfInvalidException) {
        // 419 is not a registered status code: without an explicit reason phrase
        // Apache replaces the status line with "500 Internal Server Error".
        // Always HTTP/1.1: mod_php only applies a status line starting with "HTTP/1.".
        header('HTTP/1.1 419 Page Expired', true, 419);
        require __DIR__ . '/../templates/session-expired.php';
        exit(0);
    }

    error_log("PostfixAdmin : untrapped exception. " . $exception->getMessage() . " - " . $exception->getTraceAsString());
    http_response_code(500);
    echo "<p><strong>PostfixAdmin Error:</strong></p><p>PostfixAdmin encountered an error. More details are in the server log files (e.g. /var/log/apache2/error.log).</p>";
});
