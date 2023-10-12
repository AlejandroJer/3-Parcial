<?php
namespace modelos;
 use PDO;
 class utilities extends conexion{

    private $keywords;
    private $string;

    public function __construct(){
        parent::__construct();
    }

    public function HighlightKeyword($keywords, $string){
        $this->string = $string;
        $this->keywords = $keywords;

        $start_pos = strpos($this->string, $this->keywords);

        if ($start_pos !== false) {
            $before = substr($this->string, 0, $start_pos);
            $after = substr($this->string, $start_pos + strlen($this->keywords));

            $new_string = $before . '<span class="highlight">' . $this->keywords . '</span>' . $after;
        }else{
            $new_string = $this->string;
        }

        return $new_string;
    }
 }