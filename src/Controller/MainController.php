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
     * @Route("/hearts", name="hearts")
     */
    public function hearts()
    {

        $termReq= $this->getDoctrine()->getRepository(Term::class);

        $notesmax = 30;

        $terms = $termReq->findHeartsTerms($notesmax);


        return $this->render('main/hearts.html.twig', [
            'terms' => $terms,
            'notesmax' => $notesmax
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
