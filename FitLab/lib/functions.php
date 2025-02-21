<?php
function gym_fitlab() {
    $fitlabJson = file_get_contents('data/fitlab.json');
    $products = json_decode($fitlabJson, true);

    return $products;
}

function fit_lab($fitlab)
{
    $json = json_encode($fitlab, JSON_PRETTY_PRINT);
    file_put_contents('data/fitlab.json', $json);
}

?>
