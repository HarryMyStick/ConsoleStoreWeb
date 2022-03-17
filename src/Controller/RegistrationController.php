<?php

namespace App\Controller;

use App\Entity\Accounts;

use App\Form\AccountsType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{

    private $passwordEncoder;



    public function __construct(UserPasswordEncoderInterface $passwordEncoder)

    {

        $this->passwordEncoder = $passwordEncoder;
    }



    /**

     * @Route("/registration", name="registration")

     */

    public function index(Request $request)

    {

        $Username = new Accounts();



        $form = $this->createForm(AccountsType::class, $Username);



        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            // Encode the new users password

            $Username->setPassword($this->passwordEncoder->encodePassword($Username, $Username->getPassword()));



            // Set their role

            $Username->setRoles(['ROLE_USER']);



            // Save

            $em = $this->getDoctrine()->getManager();

            $em->persist($Username);

            $em->flush();



            return $this->redirectToRoute('app_login');
        }



        return $this->render('registration/index.html.twig', [

            'form' => $form->createView(),

        ]);
    }
}
