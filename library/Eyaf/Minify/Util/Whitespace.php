<?php
abstract class Eyaf_Minify_Util_Whitespace {

    public static function stripAll($content){
        //standardise line endings
        $content = str_replace("\n\r", "\n", $content);
        //replace tabs with nothing
        $content = preg_replace('#\t#', '', $content);
        //replace newlines with spaces
        $content = preg_replace('#\n#', ' ', $content);
        //collapse spaces to one space
        $content = preg_replace('#\s+#', ' ', $content);
        return $content;
    }

}