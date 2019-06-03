<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ETLController extends Controller
{
    public function index(){

        $dirPasta = getenv('ETL_DIR').'comandos/';

        $scripts = array();

        if(is_dir($dirPasta)){            
            $diretorio = dir($dirPasta);
            while(($arquivo = $diretorio->read()) !== false){
                $pathFile = $dirPasta.$arquivo;
                $info = pathinfo($pathFile);

                if(is_file($pathFile) && $info["extension"] == "sh")
                    $scripts[] = $arquivo;
            }

            $diretorio->close();
        }

        $pathLog = getenv('ETL_DIR').'logs/';

        $logs = array();

        if(is_dir($pathLog)){            
            $dirLog = dir($pathLog);
            while(($log = $dirLog->read()) !== false){
                $pathFile = $pathLog.$log;
                $info = pathinfo($pathFile);
                
                if(is_file($pathFile) && 
                    ($info["extension"] == "log" || $info["extension"] == "html")){
                        $arquivo["filename"] = $log;
                        $arquivo["size"] = round(filesize($pathFile)/1000000, 2);
                        $logs[] = $arquivo;
                    }
                    
            }

            $dirLog->close();
        }

        //dd($logs);

        return view('admin.etl.index', compact('scripts', 'logs'));
    }

    public function downloadLog($logFile){
        $pathLogDir = getenv('ETL_DIR').'logs/';
        $pathLogFile = $pathLogDir.$logFile;

        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename="'.$logFile.'"');
        header("Content-Length: " . filesize($pathLogFile));
    
        

        $fp = fopen($pathLogFile, "r");
        fpassthru($fp);
        fclose($fp);
    }

    public function executarEtl($scriptETL){
        $pathSH = getenv('ETL_DIR').'comandos/'.$scriptETL;
        $contents = file_get_contents($pathSH);

        echo shell_exec('sh '.$pathSH);

    }
}
