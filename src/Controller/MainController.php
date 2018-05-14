<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {

    	$user = $this->get('security.token_storage')->getToken()->getUser();
		
		if ($user == "anon.") {
			return $this->redirect('/login');
		} else {
            return $this->redirect('/profile');
        }
    }
}
