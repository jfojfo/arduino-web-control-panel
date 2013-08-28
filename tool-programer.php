<div class="tool-programer">
    <span class="label label-warning">Choose file to upload:</span>
    <div style="margin-top: 10px;">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="upload" value="Go!">
        </form>
    </div>
    <div>
<?php
if (isset($_POST['upload'])) {
    $file = $_FILES["file"];
    if ($file["error"] > 0) {
        $upload_error_strings = array( false,
            "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            "The uploaded file was only partially uploaded.",
            "No file was uploaded.",
            '',
            "Missing a temporary folder.",
            "Failed to write file to disk.",
            "File upload stopped by extension."
        );
        echo "Error: " . $upload_error_strings[$file["error"]];
    } else {
        $name = $file["name"];
        $size = $file["size"];
        $output = shell_exec("/opt/bin/avrdude -p m328p -c arduino -b 57600 -P /dev/ttyUSB0 -C /opt/etc/avrdude.conf -U flash:w:".trim($name) . "2>&1");
        $output = htmlspecialchars($output);
?>
        <div class='alert'>
            <span>Successfully uploaded <b><?php echo $name; ?></b> to the Arduino with avrdude </span>
            <span>(size: <?php echo round($size/1024, 2); ?>Kb)</span>
        </div>
        <hr>
        <span class="label label-warning">avrdude output:</span>
        <div class="pre-container" style="margin-top: 10px; min-height: 100px;">
          <pre class="clear-pre"><?php echo $output; ?></pre>
        </div>
<?php
    }
}
?>
    </div>
</div>