<?php

function checkRequestMethod($allowedMethods) {
    if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
        http_response_code(405); // Method Not Allowed
        die('Method Not Allowed');
    }
}