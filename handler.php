<?php
function
loadmodule($modulecat, $module)
{
    $pages = json_decode(file_get_contents("mdec.json"), true);
    include $pages[$modulecat][$module]["src"];
}
?>