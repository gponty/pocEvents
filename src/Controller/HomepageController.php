<?php

namespace App\Controller;

use App\Entity\Compteur;
use App\Entity\Ligne;
use App\Entity\Principal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(EntityManagerInterface $em)
    {
        $ligne = new Ligne();
        $ligne->setNoLigne(1);
        $em->persist($ligne);
        dump('add ligne 1');

        $ligne = new Ligne();
        $ligne->setNoLigne(1);
        $em->persist($ligne);
        dump('add ligne 2');

        $ligne = new Ligne();
        $ligne->setNoLigne(1);
        $em->persist($ligne);
        dump('add ligne 3');
        $em->flush();

        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 0 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(true);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 3 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(false);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 0 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(true);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 3 : '.$compteur->getTotalLigne());

        $ligne = new Ligne();
        $ligne->setNoLigne(1);
        $em->persist($ligne);
        dump('add ligne 4');

        $ligne = new Ligne();
        $ligne->setNoLigne(1);
        $em->persist($ligne);
        dump('add ligne 5');
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 5 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(false);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 0 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(true);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 5 : '.$compteur->getTotalLigne());

        /*
        $lignes = $em->getRepository(Ligne::class)->findAll();
        foreach($lignes as $ligne){
            $em->remove($ligne);
        }
        $em->flush();

        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 0 : '.$compteur->getTotalLigne());

        $principal = $em->getRepository(Principal::class)->findOneBy(['id' => 1]);
        $principal->setActif(false);
        $em->flush();
        $compteur = $em->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        dump('ligne devrait être à 0 : '.$compteur->getTotalLigne());
        */


        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}
