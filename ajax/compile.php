<?php

    $htmlTextFromCKEditor = $_POST['htmlText'];

    // transform html text to raw string
    $htmlTextFromCKEditor = str_replace('<p>', '', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('</p>', '', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('&lt;', '<', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('&gt;', '>', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('&nbsp;', ' ', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('&quot;', '"', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('<br />', '', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('</span>', '', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = preg_replace('<span.*\">', '', $htmlTextFromCKEditor);
    $htmlTextFromCKEditor = str_replace('<>#include', '#include', $htmlTextFromCKEditor);

    // echo string to file
    $file = 'temp.cpp';
    file_put_contents($file, $htmlTextFromCKEditor);

    // compile temp.cpp
    // g++ <file> - compiles the file
    // -o temp.exe - sets the output executable file
    // > temp.log 2>&1 - outputs warnings/error inside temp.log
    $command = 'g++ -Wall ' . $file . ' -o temp.exe > temp.log 2>&1';
    exec($command);

    // open temp.log
    $temp = 'temp.log';
    $logs = file_get_contents($temp);

    echo json_encode($logs);

?>