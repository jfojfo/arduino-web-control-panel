<?php
$url_info = parse_url($_SERVER["REQUEST_URI"]);
$path = $url_info['path'];
$query = "programer";
if (isset($url_info['query']))
    $query = $url_info['query'];
//parse_str($str, $query_arr);
$tool = strtolower($query);
$tool_page = "tool-" . $tool . ".php";
if (!is_file(getcwd() . "/" . $tool_page)) {
    $tool = "programer";
    $tool_page = "tool-" . $tool . ".php";
}

$tool_map = array(
    'programer' => 'Programer',
    'serial' => 'Serial',
    'camera' => 'Video Camera',
    'cmd' => 'Command'
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/bootstrap-2.3.2.min.js"></script>
    <script>
        if (!window.jQuery) {
            console.log("load script from baidu cdn...");
            document.write('<link href="http://libs.baidu.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen">');
            document.write('<script src="http://libs.baidu.com/jquery/1.10.2/jquery.js"><\/script>');
            document.write('<script src="http://libs.baidu.com/bootstrap/2.3.2/js/bootstrap.min.js"><\/script>');
        }
    </script>
    <link href="css/custom.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="">Control Panel</a>
                <ul class="nav">
                <?php foreach($tool_map as $key => $value): ?>
                    <li<?php if($key === $tool) echo ' class="active"'?>>
                        <a data-toggle="pill" href="<?php echo $path . '?' . $key; ?>"><?php echo $value; ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
                <ul class="nav pull-right">
                    <li>
                        <a href="#" onclick="reboot()">Reboot</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row-fluid">
            <?php include($tool_page); ?>
        </div>
    </div>
<script>
    $('[data-toggle="pill"]').click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        window.location.href = url;
    });
</script>
</body>
</html>
