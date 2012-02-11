<?php
class LayoutPlugin extends Yaf_Plugin_Abstract {

    private $layoutDir;
    private $layoutFile;

    public function __construct($layoutDir, $layoutFile){
        $this->layoutDir = $layoutDir;
        $this->layoutFile = $layoutFile;
    }

    public function dispatchLoopShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function dispatchLoopStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function postDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function preDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
        /*get the body of the response*/
        $body = $response->getBody();

        /*wrap it in the layout*/
        $layout = new Yaf_View_Simple($this->layoutDir);
        $layout->content = $body;

        /*set the response to use the wrapped version of the content*/
        $response->setBody($layout->render($this->layoutFile));
    }

    public function preResponse ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
        
    }

    public function routerShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function routerStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }
}