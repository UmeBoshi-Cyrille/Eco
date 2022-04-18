<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_INSTRUCTOR")]
#[Route('/instructor')]
class FormationController extends AbstractController
{
    #[Route('/formations', name: 'instructor_formations')]
    public function instructorFormations(FormationRepository $formationRepository): Response
    {
        $instructorFormations = $formationRepository->findAll();

        return $this->render('instructor/instructor_formations.html.twig', [
            'instructor_formations' => $instructorFormations
        ]);
    }

    #[Route('/formation/{id}', name: 'instructor_formation')]
    public function instructorFormation($id,
        FormationRepository $formationRepository
    ): Response
    {
        $instructorFormation = $formationRepository->find($id);

        return $this->render('instructor/instructor_formation.html.twig', [
            'instructor_formation' => $instructorFormation,
        ]);
    }

    #[Route('/formation/new', name: 'formation_new')]
    public function newFormation(Request $request, 
    EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();

        $formation = $this->createForm(FormationType::class, $formation);
        
        $formation->handleRequest($request);

        if ($formation->isSubmitted() && $formation->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
        }

        return $this->render('instructor/instructor_formation_new.html.twig', [
            'formationNew' => $formation->createView(),
        ]);
    }

    // /**

    //  * @param App\Entity\Formation;
    //  */
    #[Route('/formation/update/{id}', name: 'formation_update')]
    public function updateFormation(
        $id,
        Request $request, 
        EntityManagerInterface $entityManager,
        FormationRepository $formationRepository): Response
    {
        $formation = $formationRepository->findOneBy(['id' => $id]);

        $formation = $this->createForm(FormationType::class, $formation);
        
        $formation->handleRequest($request);

        if ($formation -> isSubmitted() && $formation->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
        }

        return $this->render('instructor/instructor_formation_update.html.twig', [
            'formation_update' => $formation->createView()
        ]);
    }
   
    public function deleteFormation($id, 
        FormationRepository $formationRepository, 
        EntityManagerInterface $entityManager): Response 
    {
        $formation = $formationRepository->find($id);

        $entityManager->remove($formation);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('instructor/instructor_formations.html.twig');
    }
}
