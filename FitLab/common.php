<?php
// Used for security and formatting
function escape($data) { // Helps clean and santising the website before displaying them
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);
    return ($data);
}