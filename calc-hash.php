#!/bin/env php
<?php
// Usage: php calc-hash.php [HTML_FILE]
$htmlFile = $argv[1];

$dom = new DOMDocument();
$dom->preserveWhiteSpace = true;
$dom->formatOutput = false;
$dom->loadHTMLFile($htmlFile, LIBXML_NOERROR | LIBXML_NOWARNING);

$scripts = $dom->getElementsByTagName('script');

foreach ($scripts as $i => $script) {
    $code = $script->textContent;
    $hash = base64_encode(hash('sha256', $code, true));
    $id = $script->getAttribute('id') ?: sprintf('script %s', $i);

    printf("Script %s => 'sha256-%s'\n", $id, $hash);
}
