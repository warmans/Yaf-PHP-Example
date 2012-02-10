<?php
class IndexController extends Yaf_Controller_Abstract {

    public function indexAction() {
        $blog = new BlogModel();
        $this->_view->entries = $blog->fetchAll();
    }
    
}
