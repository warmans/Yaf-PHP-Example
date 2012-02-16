<?php 
class Bootstrap extends Yaf_Bootstrap_Abstract {

    private $_config;

    /*get a copy of the config*/
    public function _initBootstrap(){
        $this->_config = Yaf_Application::app()->getConfig();
    }

    /*
     * initIncludePath is only required because zend components have a shit load of
     * include_once calls everywhere. Other libraries could probably just use
     * the autoloader (see _initNamespaces below).
     */
    public function _initIncludePath(){
        set_include_path(get_include_path() . PATH_SEPARATOR . $this->_config->application->library);
    }

    public function _initErrors(){
        if($this->_config->application->showErrors){
            error_reporting (-1);
            ini_set('display_errors','On');
        }
    }

    public function _initNamespaces(){
        Yaf_Loader::getInstance()->registerLocalNameSpace(array("Zend"));
    }

    public function _initRoutes(){

        //this does nothing useful but shows the regex router in action...
        Yaf_Dispatcher::getInstance()->getRouter()->addRoute(
            "paging_example",
            new Yaf_Route_Regex(
                "#^/index/page/(\d+)#",
                array('controller' => "index"),
                array(1 => "page")
            )
        );
        
    }

    public function _initDefaultDbAdapter(){
        $dbAdapter = new Zend_Db_Adapter_Pdo_Sqlite(
            $this->_config->database->params->toArray()
        );

        Zend_Db_Table::setDefaultAdapter($dbAdapter);
    }

    public function _initLayout(Yaf_Dispatcher $dispatcher){
       /*layout allows boilerplate HTML to live in /views/layout rather than every script*/
        $layout = new LayoutPlugin('layout.phtml');

        /* Store a reference in the registry so values can be set later.
         * This is a hack to make up for the lack of a getPlugin
         * method in the dispatcher.
         */
        Yaf_Registry::set('layout', $layout);

        /*add the plugin to the dispatcher*/
        $dispatcher->registerPlugin($layout);
    }

    public function _initCssMinifier(){
        $minifier = new Minify(new Minify_Strategy_Css());
        $minifier->minifyDir(
            $this->_config->static->css->sourceDir,
            $this->_config->static->css->minDir
        );
    }

    public function _initJsMinifier(){
         $minifier = new Minify(new Minify_Strategy_Js());
        $minifier->minifyDir(
            $this->_config->static->js->sourceDir,
            $this->_config->static->js->minDir
        );
    }

    /*
    private function _minifyStatic($inDir, $outDir, $minifierStrategy){
        
        $buildFileLocation = $outDir.'build.last';
        $lastModified = 0;
        $buildTime = (is_file($buildFileLocation)) ? file_get_contents($buildFileLocation) : 0;

        //get dir handle
        $cssFiles = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($inDir, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        //stat files (once every 10 seconds max)
        if($buildTime > 0 && $buildTime < time()-10){
            foreach($cssFiles as $fileInfo):
                $lastModified = ($fileInfo->getMTime() > $lastModified)
                    ? $fileInfo->getMTime()
                    : $lastModified;
            endforeach;
        }

        //rebuild required?
        if($lastModified > $buildTime || ($lastModified === 0 && $buildTime === 0)){
            $minifier = new Minify($minifierStrategy);

            //re-create private folder structure and files
            foreach($cssFiles as $fileInfo):

                $itemPath = $outDir.$fileInfo->getFilename();

                switch (TRUE):
                    case $fileInfo->isFile():
                        $minifier->loadFile($fileInfo->getRealPath());
                        file_put_contents($itemPath, $minifier->minify());
                        break;
                    case $fileInfo->isDir():
                        mkdir($itemPath);
                        break;
                endswitch;
            endforeach;

            //update last build time
            file_put_contents($buildFileLocation, time());
        }   
    }*/
}
