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

    public function _initPlugins(Yaf_Dispatcher $dispatcher){

        /*layout allows boilerplate HTML to live in /views/layout rather than every script*/
        $layout = new LayoutPlugin(APP_PATH.'/views/', 'layout.phtml');
        $dispatcher->registerPlugin($layout);
        
    }

    public function _initDefaultDbAdapter(){
        $dbAdapter = new Zend_Db_Adapter_Pdo_Sqlite(
            $this->_config->database->params->toArray()
        );

        Zend_Db_Table::setDefaultAdapter($dbAdapter);
    }

}
