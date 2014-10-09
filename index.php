<?php
// quick short service url service, that redirects according to links found in links.ini, or to a default url (such as search engine) for shortcuts not found
// based on Martin Angelov script at tutorialzine.com

//config
define("REFRESHTIME", 4); //time (in seconds) to display a warning in case shortcut is not defined
define("FIXURL", "http://www.google.com/search?q=");


//usually nothing to configure below.
$start = microtime(true);

$links = parse_ini_file('links.ini');
$short = trim($_SERVER['REQUEST_URI'], '/');


if(array_key_exists($short, $links)){
    header("Location: ".$links[$short]);
}
elseif(isset($_GET["list"])){
    $end = microtime(true);
    $time = round($end - $start, 7) . " sec";
    $title = "Shortcuts on ".$_SERVER['HTTP_HOST'];

    echo <<<EOT
<html><head>
<title>$title</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sortable/0.6.0/css/sortable-theme-finder.css">
<style>body{font-family: sans-serif; font-size: 12px;}</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/sortable/0.6.0/js/sortable.min.js"></script>
</head><body>

<h2>$title</h2>
<p>Loading the list of links took $time.</p>
<table data-sortable class="sortable-theme-finder">
<thead><tr><th>#</th><th>short</th><th>long</th></thead><tbody>
EOT;
    $i = 1;
    foreach ($links as $s => $l) {
	echo "<tr> <td>".$i++."</td><td><a href='http:/".$_SERVER['HTTP_HOST']."/$s'>$s</a></td> <td><a href='$l'>".substr($l,0,70)."</a></td> </tr>\n ";
    }
    echo "</tbody></table>\n</body></html>";
}
else{
    $fix = FIXURL."$short";
    header('HTTP/1.0 404 Not Found');
    header("Refresh: REFRESHTIME; URL=$fix");
    echo "<p>Unknown shortcut <em>$short</em>, you will shortly be redirected to our default <a href='$fix'>search page</a>, we hope it helps!<p>";
    error_log("'$short' is not an existing shortcut\n", 3, dirname(__FILE__)."/url-shortener-missing.log");
//    error_log("'$short' is not an existing shortcut, add it to links.ini if needed", 1, "you@mail.org", "Subject: [error] shortcut at ".$_SERVER['HTTP_HOST']); //get a warning by mail
}
