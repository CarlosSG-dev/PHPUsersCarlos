<?php 
    class Login {
        private $route;
        private $folder;

        public function __construct($name, $parent){
            $this->folder = str_repeat("../", $parent) . "log";
            $this->route = $this->folder . "/$name.log";

            if (!file_exists($this->folder)) {
                mkdir($this->folder, 0777);
            } 
        }

        function write($line) {
            try {
                $file = fopen($this->route, "a+");
                fwrite($file, $line . "\n");
                fclose($file);
            } catch (Exception $e) {
                error_log($e);
                echo $e;
            }
        }

        function read() {
            $lines = [];
            try {
                $file = fopen($this->route, "a+");
                while(!feof($file)) {
                    array_push($lines, fgets($file));
                }
               
                fclose($file);
              
                
            } catch (Exception $e) {
                error_log($e);
                echo $e;
            }
            return $lines;
        }
    }
?>