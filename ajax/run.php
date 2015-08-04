<?php
    $file = 'temp.exe';

    if (file_exists($file)) {
        // run executable
        $command = $file . ' > output.log 2>&1';
        exec($command);

        $output = 'output.log';
        $logs = file_get_contents($output);
        echo json_encode($logs);
    }
    else {
        echo json_encode('ERROR: There is no executable file. Try compiling first!');
    }
?>