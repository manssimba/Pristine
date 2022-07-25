<?php
//make request_uri not contain anything after the ?
$request_uri = explode('?', $_SERVER['REQUEST_URI']);
$request_uri = $request_uri[0];

//go thru all pages in sdec.json and check if $_SERVER["REQUEST_URI"] matches any of their routes (modulename->page->route)
$pages = json_decode(file_get_contents("pdec.json"), true);
$found = false;
foreach ($pages as $modulename => $module) {
    foreach ($module["pages"] as $page => $pageinfo) {
        if ($pageinfo["route"] == $request_uri) {
            $found = true;
            $src = $pageinfo["src"];
            break;
        }
    }
    if ($found) {
        //include page src
        if (!(include $src)) {
            include($pages["errors"]["pages"]["failtoload"]["src"]);
        }
        break;
    }
}
if(!$found){
    include($pages["errors"]["pages"]["404"]["src"]);
}
?>