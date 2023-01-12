<?php

// Send a GET request to get the html input from another website

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ro.wikipedia.org/wiki/Spital');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$html = curl_exec($ch);

$dom = new DOMDocument();
@ $dom->loadHTML($html);

$divMwContentText = $dom->getElementById('mw-content-text');

$ps = $divMwContentText->getElementsByTagName('p');