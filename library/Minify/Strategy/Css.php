<?php
class Minify_Strategy_Css extends Minify_Strategy_Abstract {
    
    public function minify($content){
        $content = $this->_stripComments($content);
        $content = $this->_stripWhitespace($content);
        return $content;
    }
    
}