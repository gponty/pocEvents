<?php

namespace App\Listener;

use App\Entity\Compteur;
use App\Entity\Ligne;
use App\Entity\Principal;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;

class CompteurSubscriber implements EventSubscriber
{

    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preRemove,
            Events::preUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->logActivity('persist', $args);
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $this->logActivity('remove', $args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args)
    {

        $entity = $args->getObject();
        //dump($args);

        $compteur = $args->getObjectManager()->getRepository(Compteur::class)->findOneBy(['id' => 1]);
        $principal = $args->getObjectManager()->getRepository(Principal::class)->findOneBy(['id' => 1]);

        if ($entity instanceof Ligne) {
            if ($principal->getActif()) {
                if($action=='remove'){
                    $compteur->setTotalLigne($compteur->getTotalLigne() - $entity->getNoLigne());
                    dump('Event sub compteur Ligne 1');
                }else {
                    dump('Event add compteur Ligne 1');
                    $compteur->setTotalLigne($compteur->getTotalLigne() + $entity->getNoLigne());
                }
            }
        }

        if ($entity instanceof Principal) {
            $chgt = $args->getEntityChangeSet();
            if (isset($chgt['actif'])) {
                if ($entity->getActif()) {
                    dump('Event add compteur 2');
                    $lignes = $args->getObjectManager()->getRepository(Ligne::class)->findAll();
                    foreach($lignes as $ligne){
                        $compteur->setTotalLigne($compteur->getTotalLigne() + $ligne->getNoLigne());
                    }
                } else {
                    dump('Event sub compteur 2');
                    $lignes = $args->getObjectManager()->getRepository(Ligne::class)->findAll();
                    foreach($lignes as $ligne){
                        $compteur->setTotalLigne($compteur->getTotalLigne() - $ligne->getNoLigne());
                    }
                }
            }
        }
    }

}