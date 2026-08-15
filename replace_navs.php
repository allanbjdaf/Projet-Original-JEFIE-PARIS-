<?php
/**
 * Script de nettoyage du nav résiduel dans index.blade.php
 */

$filepath = __DIR__ . '/resources/views/index.blade.php';
$content = file_get_contents($filepath);

// Trouver la position de @include('components.navbar') dans la section content
$includePos = strpos($content, "@include('components.navbar')\n\n");
if ($includePos === false) {
    echo "Include not found!\n";
    exit;
}

// Trouver la position de la prochaine section après le nav ({{-- ══ HERO ══ --}})
// On cherche après l'include
$heroPattern = '{{-- ══ HERO ══ --}}';
$heroPos = strpos($content, $heroPattern, $includePos);

if ($heroPos === false) {
    echo "Hero section not found!\n";
    exit;
}

// La portion à conserver : tout ce qui est avant l'include + l'include + le héro et la suite
$beforeInclude = substr($content, 0, $includePos + strlen("@include('components.navbar')\n"));
$fromHero = substr($content, $heroPos);

$newContent = $beforeInclude . "\n" . $fromHero;

file_put_contents($filepath, $newContent);
echo "Done! Removed " . (strlen($content) - strlen($newContent)) . " chars of residual nav.\n";
echo "File size: " . filesize($filepath) . " bytes\n";
