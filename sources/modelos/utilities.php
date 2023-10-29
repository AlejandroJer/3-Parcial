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
        $trimmed_keywords = trim($this->keywords);

        $normalized_string = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $this->string));
        $normalized_keywords = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $trimmed_keywords));

        $start_pos = stripos($normalized_string, $normalized_keywords);

        if ($start_pos !== false) {
            $pattern = '/' . preg_quote($trimmed_keywords, '/') . '/i';

            $new_string = preg_replace_callback($pattern, function ($matches) {
                return '<mark class="p-0">' . $matches[0] . '</mark>';
            }, $this->string);

        }else{
            $new_string = $this->string;
        }

        return $new_string;
    }
 }