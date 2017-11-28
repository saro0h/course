<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Type\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfToken;

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

    /**
     * @Route("/delete", name="course_delete", methods={"POST"})
     */
    public function deleteAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $courseId = $request->request->get('course_id');

        if (!$course = $doctrine->getRepository('AppBundle:Course')->findOneBy(['id' => $courseId])) {
            $this->addFlash('danger', 'This course does not exist.');

            return $this->redirectToRoute('course_list');
        }

        $csrfToken = new CsrfToken('delete_course', $request->request->get('csrf_token'));

        if ($this->get('security.csrf.token_manager')->isTokenValid($csrfToken)) {
            $em = $doctrine->getManager();
            $em->remove($course);
            $em->flush();

            $this->addFlash('success', 'This course has been successfully deleted.');
        } else {
            $this->addFlash('danger', 'Csrf token not valid.');
        }

        return $this->redirectToRoute('course_list');
    }


    public function searchAction()
    {
        return $this->render('course/search.html.twig');
    }
}
