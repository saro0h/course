<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CourseController extends Controller
{
    /**
     * @Route("/course/list", name="course_list")
     */
    public function listAction()
    {
        return $this->render('course/list.html.twig');
    }

    public function searchAction()
    {
        return $this->render('course/search.html.twig');
    }
}
