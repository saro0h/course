<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Type\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/course")
 */
class CourseController extends Controller
{
    /**
     * @Route("/list", name="course_list")
     */
    public function listAction()
    {
        $courses = $this->getDoctrine()->getRepository('AppBundle:Course')->findAll();

        return $this->render('course/list.html.twig', ['courses' => $courses]);
    }

    /**
     * @Route("/create", name="course_create")
     */
    public function createAction(Request $request)
    {
        $course = new Course();
        $courseForm = $this->createForm(CourseType::class, $course);

        $courseForm->handleRequest($request);

        if ($courseForm->isValid()){

            $file = $course->getThumbnail();

            $filename = time() . "-" . $file->getClientOriginalName();

            $folder = $this->getParameter('kernel.root_dir');
            $path = $folder . '/../web/uploads';
            $file->move($path, $filename);
            $course->setThumbnail('/uploads/' . $filename);

            $em = $this->getDoctrine()->getManager();

            $em->persist($course);
            $em->flush();

            $this->addFlash('success', 'Congratulation, the course has been added.');

            return $this->redirectToRoute('course_list');
        }

        return $this->render('course/create.html.twig', ['courseForm' => $courseForm->createView()]);
    }

    public function searchAction()
    {
        return $this->render('course/search.html.twig');
    }
}
