<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/create", name="user_create")
     */
    public function createAction(Request $request, EncoderFactory $encoderFactory)
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isValid()) {
            // Get password encoder
            $encoder = $encoderFactory->getEncoder($user);

            // Encode password
            $password = $encoder->encodePassword($user->getPassword(), null);

            // Update the password of the user (otherwise you're saving the password in plain text 🤮)
            $user->setPassword($password);

            // Save the user in database
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Add flash message 🎉
            $this->addFlash('success', 'The user have been successfully added.');

            // Redirect
            return $this->redirectToRoute('course_list');
        }

        return $this->render('user/create.html.twig', ['userForm' => $userForm->createView()]);
    }
}
