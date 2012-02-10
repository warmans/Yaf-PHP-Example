<?php 
class Bootstrap extends Yaf_Bootstrap_Abstract {

    private $_config;

    public function _initBootstrap(){
        /*get a copy of the config*/
        $this->_config = Yaf_Application::app()->getConfig();
    }

    public function _initErrors(){
        error_reporting (-1);
        ini_set('display_errors','On');
    }

    public function _initNamespaces(){
        Yaf_Loader::getInstance()->registerLocalNameSpace(array("Zend"));
    }

    public function _initRoutes(){
        Yaf_Dispatcher::getInstance()->getRouter()->addRoute(
            "paging_example",
            new Yaf_Route_Regex(
                "#^/index/page/(\d)#",
                array('controller' => "index"),
                array(1 => "page")
            )
        );
    }

    public function _initDefaultDbAdapter(){
        $dbAdapter = new Zend_Db_Adapter_Pdo_Sqlite(
            (array)$this->_config->database->params->toArray()
        );

        Zend_Db_Table::setDefaultAdapter($dbAdapter);
    }

}
