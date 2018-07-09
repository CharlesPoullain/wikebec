<?php

namespace App\Controller;

use App\Entity\Term;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function home()
    {

        $termReq= $this->getDoctrine()->getRepository(Term::class);

        $terms = $termReq->findBy([], ['term' => 'ASC']);

        $displayTerm = $terms[array_rand($terms)];

        return $this->render('main/home.html.twig', [
            'terms' => $terms,
            'displayTerm' => $displayTerm
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig');
    }

}
