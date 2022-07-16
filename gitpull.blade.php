-<?php
function output($str) {
    echo $str;
    ob_end_flush();
    ob_flush();
    flush();
    ob_start();
}

function liveExecuteCommand($cmd)
{

    while (@ ob_end_flush()); // end all output buffers if any

    $proc = popen($cmd, 'r');

    $live_output     = "";
    $complete_output = "";

    while (!feof($proc))
    {
        $live_output     = fread($proc, 4096);
        $complete_output = $complete_output . $live_output;
        echo "$live_output";
        @ flush();
    }
    pclose($proc);

    // get exit status
    preg_match('/[0-9]+$/', $complete_output, $matches);

    // return exit status and intended output
//    return array (
//      'exit_status'  => intval($matches[0]),
//      'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
//    );
}
?>
<br />
<h1>Git Update</h1>

<div class="jumobotron">
    <?php
    while (@ ob_end_flush()); // end all output buffers if any
    $cmd = 'cd C:/xampp/htdocs/khotong && git pull';
    echo '<pre>';
    liveExecuteCommand($cmd);
    echo '</pre>';
    ?>
</div>