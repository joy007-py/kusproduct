<?php

namespace app\helper;

class JsonDumper implements dumpInterface
{
    public function dump( array $data )
    {
        $file_path = PROJECT_DIR . '/'. DATA_DUMP_FILE;
        if(\file_exists( $file_path ))
        {
            \unlink($file_path);
        }
        if( !empty($data) )
        {
            $fp = fopen($file_path, 'w');
            fwrite($fp, json_encode($data));
            fclose($fp);
        }
    }
}