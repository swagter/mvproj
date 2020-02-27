<?php
class Controller {

    private $user;

    

    public function __construct(User $user) {

        $this->user = $user;

    }

    public function index($request) {
		 echo $_SERVER['HTTP_USER_AGENT'];
	
        if (isset($request['action'])) 
             $this->{$request['action']}($request);     // $controller->convert([currency=>,ammount=>])

			
			require_once('view/view_01.php');
			
			$view = new UserView($this->user);
            echo $view->output();

    

    }
	
	
    //   [action=> , id=>]    - shows subview - user details
    public function uredi($request) {
	
        print_r($request);	
	
        if (isset($request['action']) && isset($request['id'])) {

            //$this->user->set($request['uredi'], $request['id']);
			
			echo $request['action'].' '.$request['id'].'<br />';
			
			require_once('view/view_02.php');
			
			$view2 = new UserDetailView($this->user);
            echo $view2->output($request['id']);

        }

    }
	
	public function vnesi($request) {
	
        print_r($request);	
	
        if (isset($request['action'])) {

            //$this->user->set($request['uredi'], $request['id']);
			
			echo $request['action'] . '<br />';
			
			require_once('view/view_03.php');
			
			$view2 = new UserDetailView1($this->user);
            echo $view2->output();

        }

    }
	
	public function spremeni($request) {
	
        print_r($request);	
	
        if (isset($request['action']) && isset($request['id'])) {

            //$this->user->set($request['uredi'], $request['id']);
			
			echo $request['action'].' '.$request['id'].'<br />';
            $this->user->updateUser($request);
        }

    }
	
	public function dodaj($request) {
	
        print_r($request);	
	
        if (isset($request['action'])) {

            //$this->user->set($request['uredi'], $request['id']);
			
			echo $request['action'].'<br />';
            $this->user->addUser($request);
        }

    }
	
	
	public function odstrani($request) {
	
        print_r($request);	
	
        if (isset($request['action']) && isset($request['id'])) {

            //$this->user->set($request['uredi'], $request['id']);
			
			echo $request['action'].' '.$request['id'].'<br />';
            $this->user->removeUserByID($request['id']);
        }

    }
	
	

}