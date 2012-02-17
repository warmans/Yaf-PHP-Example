<?php
class Eyaf_Minify_Strategy_Css extends Eyaf_Minify_Strategy_Abstract {
    
    public function minify($content){

        $content = Eyaf_Minify_Util_Comments::stripBlockComments($content);
        $content = Eyaf_Minify_Util_Whitespace::stripAll($content);
        return $content;
        
    }
    
}