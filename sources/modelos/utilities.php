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

        $accents = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú');
        $without_accents = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');
        
        $normalized_string = str_ireplace($accents, $without_accents, $this->string);
        $normalized_keywords = str_ireplace($accents, $without_accents, $this->keywords);


        $start_pos = stripos($normalized_string, $normalized_keywords);

        if ($start_pos !== false) {
            $pattern = '/' . preg_quote($normalized_keywords, '/') . '/i';
            $original_string = $this->string;

            $new_string = preg_replace_callback($pattern, function ($matches) use ($original_string) {
                $original = substr($original_string, strpos(strtolower($original_string), strtolower($matches[0])), strlen($matches[0]));
                return '<span class="highlight">' . $original . '</span>';
            }, $this->string);
            
        }else{
            $new_string = $this->string;
        }

        return $new_string;
    }
 }