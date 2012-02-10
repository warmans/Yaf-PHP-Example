<?php
class IndexController extends Yaf_Controller_Abstract {

    public function indexAction() {
        $page = ($this->getRequest()->getParam('page')) ?: 0; //unused - see Bootstrap::_initRoutes
        
        $blog = new BlogModel();
        $this->_view->entries = $blog->fetchAll();
        $this->_view->page = $page;
    }
    
}
