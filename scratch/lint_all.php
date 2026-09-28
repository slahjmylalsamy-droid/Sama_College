<?php
function lintDir($dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $errorCount = 0;
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $path = $file->getRealPath();
            // Skip run test files and scratch directory files
            if (strpos($path, 'scratch') !== false || strpos($path, 'run_') !== false) {
                continue;
            }
            $output = [];
            $returnVar = 0;
            exec("C:\\xampp1\\php\\php.exe -l " . escapeshellarg($path), $output, $returnVar);
            if ($returnVar !== 0) {
                echo "SYNTAX ERROR in file: $path\n";
                echo implode("\n", $output) . "\n\n";
                $errorCount++;
            }
        }
    }
    echo "Linting complete. Total files with errors: $errorCount\n";
}

lintDir('c:/xampp1/htdocs/Sama_College');
?>
