<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Entity\Client;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
// use App\Controller\ExemplesSportController;
use App\Entity\Inscription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesSportController extends AbstractController
{
    #[Route('/exemples/sport/exemple/insert')]
    public function exempleInsert(EntityManagerInterface $em): Response
    {
        $sport1 = new Sport(['nom'=>'Judo', 'categorie'=>'Sport de combat']);
        
        $em->persist ($sport1);
        $em->flush();

        dd($sport1);
        
        return $this->render('exemples_sport/exemple_insert.html.twig');
    }

    #[Route('/exemples/sport/exemple/insert/manager/registry')]
    public function exempleInsertManager(ManagerRegistry $doctrine): Response
    {
        $sport1 = new Sport(['nom'=>'Judo', 
                            'categorie'=>'Sport de combat'
        ]);

        $sport2 = new Sport(['nom'=>'Rugby', 
                            'categorie'=>'Sport collectif'
        ]);
        
        $em = $doctrine->getManager();
        $em->persist ($sport1);
        $em->persist ($sport2);
        $em->flush();
        dump ($sport1);
 
        
        return $this->render('exemples_sport/exemple_insert.html.twig');
    }

    #[Route('/exemples/sport/exemple/insert/manager/registry/client')]
    public function exempleInsertManagerRegistryClient (ManagerRegistry $doctrine){
        $c1 = new Client(['nom'=>'François',
                        'prenom'=>'Anaïs', 
                        'email'=>'anais@gmail.com']);

        $em = $doctrine->getManager();
        $em->persist($c1);
        $em->flush();
        dump ($c1);

    }

    #[Route('/exemples/sport/exemple/select/find/one/by')]
    public function exempleSelectFindOneBy(ManagerRegistry $doctrine){

        $em = $doctrine->getManager();
        $rep = $em->getRepository(Sport::class);
        $objetSport = $rep->findOneBy([
            'nom'=>'football',
            'categorie'=>'Sport Collectif'
        ]);

        //dump ($objetSport->getNom());
        //dump ($objetSport->getCategorie());
        //dd($objetSport);

        $vars = ['sport' =>$objetSport];
        return $this->render('exemples_sport/exemple_select_find_one_by.html.twig', $vars);
    }


    #[Route('/exemples/sport/exemple/select/find/all')]
    public function exempleFindAll(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $rep = $em->getRepository(Sport::class);
    

        // dump ($rep->getNom());
        $objetSport = $rep->findAll();
        $vars = ['sports' => $objetSport];
    
        return $this->render("exemples_sport/exemple_select_find_all.html.twig", $vars);
    }


    #[Route('/exemples/sport/exemple/select/formulaire', name:"inscription_user")]
    public function exempleInscription()
    {
        $inscription = new Inscription();
        $formulaireInscription = $this->createForm(UserType::class, $inscription, array(
            'action' => $this->generateUrl("rajouter_inscription"), // name de la route!
            // si on n'utilise pas le name d'une route on doit l'écrire à la main... mauvaise idée
            // 'action' => "/exemples/formulaires/livre/rajouter", 
            'method' => 'POST'
        ));
        $vars = ['unFormulaire' => $formulaireInscription->createView()];


        return $this->render('/exemples_sport/exemple_formulaire.html.twig', $vars);
    }

    #[Route("/exemples/sport/exemple/select/formulaire/rajouter",name:"rajouter_inscription")]
    public function rajouterInscription()
    {

        dump("Inscription validée");
        // die();
        return $this->render('/exemples_sport/exemple_inscription_valide.html.twig');
    }
}


