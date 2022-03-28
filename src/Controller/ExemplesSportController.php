<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Sport;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExemplesSportController extends AbstractController
{
    #[Route('/exemples/sport/exemple/insert')]
    public function exempleInsert(EntityManagerInterface $em): Response
    {
        $sport1 = new Sport(['nom'=>'Football', 'categorie'=>'Sport collectif']);
        
        $em->persist ($sport1);
        $em->flush();

        dd($sport1);
        
        return $this->render('exemples_sport/exemple_insert.html.twig');
    }

    #[Route('/exemples/sport/exemple/insert/manager/registry')]
    public function exempleInsertManager(ManagerRegistry $doctrine): Response
    {
        $sport1 = new Sport(['nom'=>'Football', 
                            'categorie'=>'Sport collectif'
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
}


