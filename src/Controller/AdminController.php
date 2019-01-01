<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function home(){
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}
}
