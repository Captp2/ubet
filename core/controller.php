<?php
class Controller{
    protected $vars = array();
    protected $layout = 'pagedefault';

    function __construct(){
        if (isset($_POST)){
            $this->data = $_POST;   
        }
        if(isset($_SESSION['auth'])){
            $this->setLayout('loggedin');
        }
        if(!empty($this->data) && !isset($this->data['email'])){
            $modelsUser = $this->loadModel('Users');
            $user = $modelsUser->login($this->data);
            if($user){
                $_SESSION['auth'] = $user;
            }else{
                $data['login'] = '<p class="warning">The username and the password doesn\'t match.</p>';
            }
        }
        if(!empty($this->data) && isset($this->data['email'])){
            $modelsUser = $this->loadModel('Users');
            $data['subscription'] = $modelsUser->checkSubscription($this->data);
        }
        if(isset($_SESSION['auth'])){
            $this->setLayout('loggedin');
            if($_SESSION['auth']->rights == 1){
                $this->setLayout('admin');
            }
        }
    }

    function setLayout($layout){
        $this->layout = $layout;
    }

    function render($filename, $data){
        extract($data);
        ob_start();
        require(ROOT.'views/'.get_class($this).'/'.$filename.'.php');
        $content_for_layout = ob_get_clean();
        if($this->layout == false){
            echo $content_for_layout;
        } else {
            require(ROOT.'views/layout/' . $this->layout . '.php');
        }
    }

    function loadModel($name){
        require_once(ROOT.'models/'.strtolower($name).'Model.php');
        $this->$name = new $name();
        return($this->$name);
    }

    function loginAndSubscribe(){

    }
}