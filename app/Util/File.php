<?php


namespace App\Util;

use Exception;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class File
{

    static function downloadZip($file_zip = "/tmp/new.zip", $url) : bool 
    {
        print("Downloading...".PHP_EOL);
        $ch = curl_init();
        $fp = fopen($file_zip, "w"); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER,0); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);

        $page = curl_exec($ch);

        if (!$page) {
            print(curl_error($ch).PHP_EOL);
            return false;
        }
        curl_close($ch);
        return true;
    }
    static function UnZip(string $file_zip, string $file_csv) : bool 
    {
        print("Unziping...".PHP_EOL);
        try{
            $zip = new ZipArchive;
            if (! $zip) 
                return false;
            
            if($zip->open("$file_zip") != "true")
                return false;

            $zip->extractTo($file_csv);
            $zip->close();

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    static function csvToArray($filename = '', $delimiter = ',') : array 
    {
        print("Transforming to array...".PHP_EOL);
        if (!file_exists($filename) || !is_readable($filename))
            throw new Exception("File does not exists {$filename}", 1);
            

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 10000, $delimiter, '"')) !== FALSE) {
                if (!$header){
                    $header = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row);
                    $header = array_map('strtolower', $header);
                }
                else{
                    if(count($row) === 0)
                        continue;

                        try {
                            $data[] = array_combine($header, $row);
                        } catch (\Throwable $th) {
                            continue;
                        }
                }

            }
            fclose($handle);
        }
        return $data;
	}

    static function deletarPasta($pasta) : bool
    { 

        try {
            $iterator = new RecursiveDirectoryIterator($pasta,FilesystemIterator::SKIP_DOTS);
            $rec_iterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
            foreach($rec_iterator as $file){ 
                $file->isFile() ? unlink($file->getPathname()) : rmdir($file->getPathname()); 
            } 
            rmdir($pasta);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
        
    }
    
    static function deletar($pathFilename) : bool
    { 
        return unlink($pathFilename); 
    }
}