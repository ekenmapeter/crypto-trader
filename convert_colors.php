<?php

$files = glob(__DIR__ . '/resources/views/auth/*.blade.php');

$replacements = [
    'background: #000000;' => 'background: #f7f9fc;',
    'rgba(30, 30, 30, 0.7)' => 'rgba(10, 61, 145, 0.08)', // grid lines
    'linear-gradient(135deg, #0a0a0a 0%, #000000 100%)' => '#ffffff', // .gradient-bg
    '0 0 20px rgba(255, 255, 255, 0.1)' => '0 4px 24px rgba(10, 61, 145, 0.10)', // .glow
    '0 0 15px rgba(255, 255, 255, 0.05)' => '0 2px 10px rgba(10, 61, 145, 0.05)', // .input-glow
    'linear-gradient(45deg, #333, #000, #333, #000)' => 'linear-gradient(45deg, #0a3d91, #f5a623, #0a3d91, #f5a623)', // .gradient-border::after
    'rgba(255, 255, 255, 0.5)' => 'rgba(10, 61, 145, 0.3)', // particles
    'text-white' => 'text-[#1a1a2e]',
    'text-gray-400' => 'text-[#4a5568]',
    'text-gray-500' => 'text-[#718096]',
    'text-gray-600' => 'text-[#4a5568]',
    'bg-gray-900 bg-opacity-50' => 'bg-[#ffffff]',
    'border-gray-800' => 'border-[#e2e8f0]',
    'focus:border-gray-600' => 'focus:border-[#0a3d91]',
    'border-gray-700' => 'border-[#e2e8f0]',
    'from-white to-gray-500' => 'from-[#0a3d91] to-[#1258c4]',
    'hover:from-gray-300 hover:to-gray-400 text-black' => 'hover:from-[#1258c4] hover:to-[#0a3d91] text-white',
    'bg-gradient-to-r from-white to-gray-400' => 'bg-gradient-to-r from-[#0a3d91] to-[#1258c4]',
    'text-black' => 'text-white',
    'text-gray-300' => 'text-[#1258c4]', // for hover links
    'bg-purple-600' => 'bg-[#f5a623]',
    'hover:bg-purple-700' => 'hover:bg-[#e09418]',
    'text-gray-100' => 'text-white', // register button text, keep it white
    'border-gray-500' => 'border-[#0a3d91]',
];

// Reverting text-white inside buttons to remain white text
$fixWhiteTexts = [
    'text-white font-bold' => 'text-white font-bold',
    'text-[#1a1a2e] font-bold' => 'text-white font-bold',
    'fas fa-coins text-[#1a1a2e]' => 'fas fa-coins text-white',
];

foreach ($files as $file) {
    if (basename($file) == 'verify-email.blade.php') {
        // verify-email has no specific overrides that fail, but continue normally
    }
    
    $content = file_get_contents($file);
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    foreach ($fixWhiteTexts as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Also change slide background colours in login & register if any
    $content = str_replace('background-color: #1a1a1a;', 'background-color: #0a3d91;', $content);
    
    file_put_contents($file, $content);
}

echo "Done converting auth blades to blue/white theme.\n";
