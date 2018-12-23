<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionnairesController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $questionnaire = new Questionnaire();

        $form = $this->createForm(QuestionnaireType::class, $questionnaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionnaire = $form->getData();

            return new Response(var_export($questionnaire));
        }

        return $this->render('questionnaires/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
