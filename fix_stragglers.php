<?php

$files = glob(__DIR__ . '/resources/views/auth/*.blade.php');

$replacements = [
    'bg-gray-800' => 'bg-white',
    'focus:ring-gray-600' => 'focus:ring-[#0a3d91]',
    'text-white">' => 'text-[#1a1a2e]">',
    'bg-gray-900 bg-opacity-50' => 'bg-[#ffffff]',
    '<h1 class="text-2xl font-bold text-white">' => '<h1 class="text-2xl font-bold text-[#1a1a2e]">',
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    file_put_contents($file, $content);
}

echo "Done fixing remaining dark theme stragglers.\n";
