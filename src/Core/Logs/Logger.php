<?php

namespace Drakon\Core\Logs;

class Logger {

    private string $logo_file;
    private array $level;

    const LEVELS = [
        'DEBUG'    => 1,
        'INFO'     => 2,
        'WARNING'  => 3,
        'ERROR'    => 4,
        'CRITICAL' => 5
    ];

    public function __construct(string $logFile, string $level = 'DEBUG'){
        $this->logo_file = $logFile;
        $this->level = self::LEVELS[strtoupper($level)];
    }

    public function log(string $message, string $level = 'INFO'){
        $currentLevel = self::LEVELS[strtoupper($level)];

        if($currentLevel >= $this->level):
            $logEntry = sprintf(
                "[%s] [%s] %s\n",
                date('Y-m-d H:i:s'),
                $level,
                $message
            );

            file_put_contents($this->logo_file, $logEntry, FILE_APPEND);
        endif;
    }

    public function debug($message){
        $this->log($message, 'DEBUG');
    }

    public function info($message){
        $this->log($message, 'INFO');
    }

    public function warning($message){
        $this->log($message, 'WARNING');
    }

    public function error($message){
        $this->log($message, 'ERROR');
    }

    public function critical($message){
        $this->log($message, 'CRITICAL');
    }
}