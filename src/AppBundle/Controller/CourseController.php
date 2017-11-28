<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Type\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        return $this->render('course/list.html.twig');
    }

    /**
     * @Route("/create", name="course_create")
     */
    public function createAction()
    {
        $course = new Course();
        $courseForm = $this->createForm(CourseType::class, $course);

        return $this->render('course/create.html.twig', ['courseForm' => $courseForm->createView()]);
    }

    public function searchAction()
    {
        return $this->render('course/search.html.twig');
    }
}
