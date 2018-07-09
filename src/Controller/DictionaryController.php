<?php

namespace App\Controller;

use App\Entity\Term;
use App\Form\TermType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DictionaryController extends Controller
{
    /**
     * @Route("/termDetail/{id}", name="termDetail")
     */
    public function termDetail($id) {
        $termReq= $this->getDoctrine()->getRepository(Term::class);

        $term = $termReq->find($id);

        return $this->render('dictionary/detail.html.twig', [
            'term' => $term
        ]);
    }

    /**
     * @Route("/termAdd/", name="termAdd")
     */
    public function termAdd() {
        $termReq= $this->getDoctrine()->getRepository(Term::class);
        $term = new Term();
        $termForm = $this->createForm(TermType::class, $term);


        return $this->render('dictionary/ad.html.twig', [
            "termForm" => $termForm->createView()
        ]);
    }
}
