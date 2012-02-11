<?php
class IndexController extends Yaf_Controller_Abstract {

    private $_layout;

    public function init(){
        $this->_layout = Yaf_Registry::get('layout');
    }

    public function indexAction() {
        
        $page = ($this->getRequest()->getParam('page')) ?: 0; //unused - see Bootstrap::_initRoutes

        $blog = new BlogModel();

        /*view*/
        $this->_view->entries = $blog->fetchAll();
        $this->_view->page = $page;

        /*layout*/
        $this->_layout->meta_title = 'A Blog';
    }
    
}
