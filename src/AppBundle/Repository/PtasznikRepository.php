<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PtasznikRepository
 */
class PtasznikRepository extends \Doctrine\ORM\EntityRepository {

    public function findAllOrderBy($field, $order) {
        return $this->findBy(array(), array($field => $order));
    }

    public function findAllWhere($find) {
        $query = "SELECT p FROM AppBundle:Ptasznik p WHERE p.id LIKE '%$find%' OR "
                . "p.kodEan LIKE '%$find%' OR "
                . "p.nazwaLacinska LIKE '%$find%' OR "
                . "p.nazwaPolska LIKE '%$find%' OR "
                . "p.lpWPartii LIKE '%$find%' OR "
                . "p.uwagi LIKE '%$find%' OR "
                . "p.zakupRozmiar LIKE '%$find%' OR "
                . "p.aktualnyRozmiar LIKE '%$find%' OR "
                . "p.plec LIKE '%$find%' OR "
                . "p.wydrukEtykiety LIKE '%$find%'";

        $session = getSession();


        return $this->getEntityManager()
                        ->createQuery($query)
                        ->getResult();
    }

    public function findBySession($session, $currentPage = 1, $limit) {
        $query = "SELECT p.id, m.nazwa as magazyn, t.nazwa as terrarium, p.kodEan, p.nazwaLacinska, p.nazwaPolska,"
                . " p.uwagi, p.lpWPartii, p.kodDostawy, p.zakupRozmiar, p.aktualnyRozmiar,"
                . " p.plec, p.wydrukEtykiety FROM AppBundle:Ptasznik p "
                . "LEFT JOIN AppBundle:Magazyn m  WITH p.magazyn=m.id"
                . " LEFT JOIN AppBundle:Terrarium t WITH p.terrarium=t.id";
        if ($session->get('find')) {
            $find = trim($session->get('find'));
            $query .= " WHERE p.id LIKE '$find' OR "
                    . "p.kodEan LIKE '$find' OR "
                    . "p.nazwaLacinska LIKE '%$find%' OR "
                    . "p.nazwaPolska LIKE '%$find%' OR "
                    . "p.lpWPartii LIKE '%$find%' OR "
                    . "p.uwagi LIKE '%$find%' OR "
                    . "p.zakupRozmiar LIKE '%$find%' OR "
                    . "p.aktualnyRozmiar LIKE '%$find%' OR "
                    . "p.plec LIKE '%$find%' OR "
                    . "m.nazwa LIKE '%$find%' OR "
                    . "m.nazwaSkrocona LIKE '%$find%' OR "
                    . "t.nazwa LIKE '%$find%' OR "
                    . "t.opis LIKE '%$find%' OR "
                    . "t.pojemnosc LIKE '%$find%' OR "
                    . "t.rozmiar LIKE '%$find%' OR "
                    . "p.wydrukEtykiety LIKE '%$find%'";
        }
        /* if($session->get('field')){
          $field = $session->get('field');
          $order = $session->get('order');
          $query .= " ORDER BY p.$field $order";
          } */

        $result = $this->getEntityManager()
                ->createQuery($query);

        $paginator = $this->paginate($result, $currentPage, $limit);

        return $paginator;
    }

    public function paginate($dql, $page = 1, $limit = 10) {
        $paginator = new Paginator($dql);
        $paginator->setUseOutputWalkers(false);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

    public function findByIds($ids) {
        $query = "SELECT p.id, m.nazwa as magazyn, t.nazwa as terrarium, p.kodEan, p.nazwaLacinska, p.nazwaPolska,"
                . " p.uwagi, p.lpWPartii, p.kodDostawy, p.zakupRozmiar, p.aktualnyRozmiar,"
                . " p.plec, p.wydrukEtykiety FROM AppBundle:Ptasznik p "
                . "LEFT JOIN AppBundle:Magazyn m  WITH p.magazyn=m.id"
                . " LEFT JOIN AppBundle:Terrarium t WITH p.terrarium=t.id"
                . " WHERE ";
        $i = 0;
        $len = count($ids) - 1;
        foreach ($ids as $id) {
            $query .= "p.id = $id";
            if ($i < $len)
                $query .= " OR ";
            $i++;
        }
        

        return $this->getEntityManager()->createQuery($query)
                        ->getResult();
    }
    
    public function findByKodEans($kodyEan){
        $query = "SELECT p.id, m.nazwa as magazyn, t.nazwa as terrarium, p.kodEan, p.nazwaLacinska, p.nazwaPolska,"
                . " p.uwagi, p.lpWPartii, p.kodDostawy, p.zakupRozmiar, p.aktualnyRozmiar,"
                . " p.plec, p.wydrukEtykiety FROM AppBundle:Ptasznik p "
                . "LEFT JOIN AppBundle:Magazyn m  WITH p.magazyn=m.id"
                . " LEFT JOIN AppBundle:Terrarium t WITH p.terrarium=t.id"
                . " WHERE ";
        $i = 0;
        $len = count($kodyEan) - 1;
        foreach ($kodyEan as $kodEan) {
            $query .= "p.kodEan = $kodEan";
            if ($i < $len)
                $query .= " OR ";
            $i++;
        }
        

        return $this->getEntityManager()->createQuery($query)
                        ->getResult();
    }
    public function findByKodEan($kodEan){
        $query = "SELECT p FROM AppBundle:Ptasznik p WHERE p.kodEan = '$kodEan'";


        return $this->getEntityManager()
                        ->createQuery($query)
                        ->setFirstResult(0)
                        ->setMaxResults(1)
                ->getSingleResult();
    }
    
    public function findByKodEanRange($kodEan1, $kodEan2){
        $query = "SELECT p FROM AppBundle:Ptasznik p WHERE p.kodEan >= $kodEan1 AND p.kodEan <= $kodEan2";


        return $this->getEntityManager()
                        ->createQuery($query)
                        ->getResult();
    }

}
