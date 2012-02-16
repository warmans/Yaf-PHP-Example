<?php
abstract class Minify_Strategy_Abstract {
    
    protected $_content;
    
    abstract public function minify($content);

    protected function _stripComments($content){
        //block comments
        $content = preg_replace('#\/\*.*?\*\/#is', '', $content);
        //slash comments
        $content = preg_replace('#\/\/.*?\n#is', '', $content); 
        
        return $content;
    }

    protected function _stripWhitespace($content){
        //replace tabs with nothing
        $content = preg_replace('#\t#', '', $content);
        //replace newlines with spaces
        $content = preg_replace('#\n#', ' ', $content);
        //collapse spaces to one space
        $content = preg_replace('#\s+#', ' ', $content);
        return $content;
    }    
}