<?php
abstract class Eyaf_Minify_Util_Comments {

    public static function stripSlashComments($content){
        return preg_replace('#\/\/.*?\n#is', '', $content);
    }

    public static function stripBlockComments($content){
        return preg_replace('#\/\*.*?\*\/#is', '', $content);
    }
}