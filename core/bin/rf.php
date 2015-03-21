#!/usr/bin/php
<?php
if (PHP_SAPI === 'cli'){
    if( $argc < 2 ) die("\nPlease run with --help to check usage\n\n");

    $argv[1]::$argv[2]($argv[3]);


} else {
    echo "please run this in CLI mode only";
}



class create{
static function project($name)
{
    echo "\nCreating project: ".$name."\n";
    echo "Creating apps Folder...";
    try {mkdir("apps",0777,true);echo "OK\n";} catch (Exception $e){ echo "Error!\n".$e->getMessage();}
    echo "Creating logs Folder...";
    try {mkdir("logs",0777,true);echo "OK\n";} catch (Exception $e){ echo "Error!\n".$e->getMessage();}
    echo "Creating config Folder...";
    try {mkdir("config",0777,true);echo "OK\n";} catch (Exception $e){ echo "Error!\n".$e->getMessage();}
    copy('vendor/react/reactful/core/data/server.php','./server.php');
}
    static function module($name)
    {
        echo "\nCreating module: ".$name."...";
        try {mkdir("apps/".$name,0777,true);echo "OK\n";} catch (Exception $e){ echo "Error!\n".$e->getMessage();}
    }
}

class delete{
static function project($name)
{
    echo "deleting project: ".$name;
}
}