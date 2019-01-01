<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="users")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }



    /**
     * @Route("/user/new" , name="add_user")
     * @Route("/user/{id}/edit" , name="edit_user")
     */
    public function form(User $user = null, Request $request, ObjectManager $manager){
        if(!$user){
            $user = new User();
        }

        $form = $this->createFormBuilder($user)->add('nom')
                                                ->add('prenom')
                                                ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$user->getId()){
                $user->setCreatedAt(new \DateTime());
            }

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('users');
        }

        return $this->render('user/user.add.html.twig',[
            'form' => $form->createView(),
            'editMode' => $user->getId() !== null
        ]);
    }

    /**
     * @Route("/users/{id}" , name="show_user")
     */
    public function show($id){
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);
        return $this->render('user/show.html.twig',[
            'user' => $user
        ]);
    }

    /**
     * @Route("/user/{id}/delete" , name="delete_user")
     */
    public function delete($id, ObjectManager $manager){
        if($this->getUser()){
            $repo = $this->getDoctrine()->getRepository(User::class);
            $user = $repo->find($id);
            if($user){
                $manager->remove($user);
                $manager->flush();
                return $this->redirectToRoute('users');
            }
        }
        return $this->redirectToRoute('users');
    }
}
