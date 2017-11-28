<?php

namespace AppBundle\Controller;

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
        return $this->render('course/create.html.twig');
    }

    public function searchAction()
    {
        return $this->render('course/search.html.twig');
    }
}
