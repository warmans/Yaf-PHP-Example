<?php
class Eyaf_Minify {
    
    private $_strategy;

    public function  __construct(Eyaf_Minify_Strategy_Abstract $strategy) {
        $this->_strategy = $strategy;
    }

    public function minifyString($content){
        return $this->_strategy->minify($content);
    }
    
    public function minifyFile($inFile, $outFile){
        $file = new SplFileObject($inFile);
        if($file->isFile() && $file->isReadable()){
            return file_put_contents($outFile, $this->minifyString(file_get_contents($inFile)));
        } else {
            throw new Exception('Invalid File: '.$inFile);
        }
    }

    public function minifyDir($inDir, $outDir){
        $buildFileLocation = $outDir.'build.last';
        $lastModified = 0;
        $buildTime = (is_file($buildFileLocation)) ? file_get_contents($buildFileLocation) : 100000000;

        //get dir handle
        $paths = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($inDir, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        //stat files (once every 10 seconds max)
        if($buildTime > 0 && $buildTime < time()-10){
            foreach($paths as $fileInfo):
                $lastModified = ($fileInfo->getMTime() > $lastModified)
                    ? $fileInfo->getMTime()
                    : $lastModified;
            endforeach;
        }

        //rebuild required?
        if($lastModified > $buildTime || ($lastModified === 0 && $buildTime === 0)){
            
            //re-create private folder structure and files
            foreach($paths as $fileInfo):

                //get relative path
                $outputPath = $outDir.$paths->getSubIterator()->getSubPathname();
                
                switch (TRUE):
                    case $fileInfo->isFile():
                        $this->minifyFile($fileInfo->getRealPath(), $outputPath);
                        break;
                    case $fileInfo->isDir():
                        if(!is_dir($outputPath)){
                            mkdir($outputPath);
                        }
                        break;
                endswitch;
            endforeach;

            //update last build time
            file_put_contents($buildFileLocation, time());
        }

        return TRUE;
    }
}