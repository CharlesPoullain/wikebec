<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Commentary;
use App\Entity\Term;
use App\Form\CommentaryType;
use App\Form\TermType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DictionaryController extends Controller
{
    /**
     * @Route("/termDetail/{id}", name="termDetail")
     */
    public function termDetail($id, Request $request) {
        $termReq= $this->getDoctrine()->getRepository(Term::class);
        $term = $termReq->find($id);

        $terms = $termReq->findBy([], ['term' => 'ASC']);

        $previouscommentary = $term->getCommentaries();

        $commentary = new Commentary();
        $commentaryForm = $this->createForm(CommentaryType::class, $commentary);

        $commentaryForm->handleRequest($request);

        if($commentaryForm->isSubmitted() && $commentaryForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $commentary->setTerm($term);
            $commentary->setUser($this->getUser());
            $commentary->setDateCreated(new \DateTime());

            $em->persist($commentary);

            $em->flush();

            $this->addFlash("success", "Votre commentaire a bien été ajouté !");

            return $this->redirectToRoute('termDetail', ["id" => $term->getId()]);
        }


        return $this->render('dictionary/detail.html.twig', [
            'term' => $term,
            'terms' => $terms,
            'previouscommentary' => $previouscommentary,
            'commentaryForm' => $commentaryForm->createView()
        ]);
    }

    /**
     * @Route("/termAdd", name="termAdd")
     */
    public function termAdd(Request $request) {
        $termReq= $this->getDoctrine()->getRepository(Term::class);
        $term = new Term();
        $termForm = $this->createForm(TermType::class, $term);

        $termForm->handleRequest($request);

        if($termForm->isSubmitted() && $termForm->isValid()) {

            $datetime = new \DateTime();
            $timestamp = $datetime->getTimestamp();

            $em = $this->getDoctrine()->getManager();
            $term->setVotesCount(0);
            $term->setEditedDate($timestamp);
            $term->setCreatedDate($timestamp);
            $em->persist($term);
            $em->flush();

            $this->addFlash("success", "Votre terme a bien été ajouté !");


            return $this->redirectToRoute('termDetail', ["id" => $term->getId()]);
        }

        return $this->render('dictionary/adterm.html.twig', [
            "termForm" => $termForm->createView()
        ]);
    }

    /**
     * @Route("/termUpdate/{id}", name="termUpdate")
     */
    public function termEdit(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repoTerm = $em->getRepository(Term::class);
        $term = $repoTerm->find($id);

        $termForm = $this->createForm(TermType::class, $term);

        $termForm->handleRequest($request);
        if($termForm->isSubmitted() && $termForm->isValid()) {
            if (!$term) {
                throw $this->createNotFoundException(
                    'Pas de terme trouvé pour l\'id '.$id
                );
            }

            $em->persist($term);
            $em->flush();
            $this->addFlash("success", "Votre terme a bien été modifiée !");

            return $this->redirectToRoute('termDetail', ["id" => $term->getId()]);
        }

        return $this->render('dictionary/update.html.twig', [
            "termForm" => $termForm->createView(),
            "term" => $term
        ]);

    }

    /**
     * @Route("/termDelete/{id}", name="termDelete")
     */
    public function termDelete(Request $resquest, $id) {

        $em = $this->getDoctrine()->getManager();
        $term = $em->getRepository(Term::class)->find($id);

        $em->remove($term);
        $em->flush();

        $this->addFlash("success", "Votre terme a bien été suprimée !");

        return $this->redirectToRoute('main');

    }

    /**
     * @Route("/termSearch", name="termSearch")
     */
    public function termSearch(Request $req) {

        $termRepo = $this->getDoctrine()->getRepository(Term::class);
        $keyword = $req->query->get("keyword");

        $terms = $termRepo->findSearchTerms($keyword);

        return $this->render("dictionary/search.html.twig", ["terms" => $terms]);

    }

    /**
     * @Route("/term/{id}", name="rateterm")
     */
    public function rateterm($id) {
        $em = $this->getDoctrine()->getManager();
        $repoTerm = $em->getRepository(Term::class);
        $term = $repoTerm->find($id);
        $term->setVotesCount($term->getVotesCount()+1);

        $em->persist($term);
        $em->flush();

        return $this->redirectToRoute('termDetail', ["id" => $term->getId()]);

    }

}
