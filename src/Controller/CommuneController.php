<?php
namespace App\Controller;

use App\Entity\Commune;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommuneController extends AbstractController
{

    #[Route('communes/map', name: 'commune_map')]
   public function map(Request $request, EntityManagerInterface $em): Response
   {
       $sw = explode(',', $request->query->get('sw'));
       $ne = explode(',', $request->query->get('ne'));

       $swLat = floatval($sw[0]);
       $swLng = floatval($sw[1]);
       $neLat = floatval($ne[0]);
       $neLng = floatval($ne[1]);

       $query = $em->createQuery(
           'SELECT 
           c.id, 
           c.code_commune, 
           c.code_postal, 
           c.nom_commune, 
           d.nom_departement, 
           r.nom_region, 
           p.latitude, 
           p.longitude 
           FROM App\Entity\Commune c
           JOIN c.position p
           JOIN c.departement d
           JOIN c.region r
           WHERE p.latitude >= :swLat 
           AND p.longitude >= :swLng
           AND p.latitude <= :neLat 
           AND p.longitude <= :neLng'
       );

       $query->setParameters([
           'swLat' => $swLat,
           'swLng' => $swLng,
           'neLat' => $neLat,
           'neLng' => $neLng,
       ]);

       $communes = $query->getResult();
       //dump($communes);

       $response = new Response(json_encode($communes));
       $response->headers->set('Content-Type', 'application/json');
       return $response;
   }

   #[Route('communes/search', name: 'commune_search')]
   public function search(Request $request, EntityManagerInterface $em): Response
   {
    $nameToFind = $request->query->get('search');
    $nameToFind = mb_strtoupper($nameToFind, 'UTF-8');
    $nameToFind = mb_convert_encoding($nameToFind, 'UTF-8');

    $query = $em->createQuery(
        'SELECT 
        c.id, 
        c.code_commune, 
        c.code_postal, 
        c.nom_commune, 
        d.nom_departement, 
        r.nom_region, 
        p.latitude, 
        p.longitude 
        FROM App\Entity\Commune c
        JOIN c.position p
        JOIN c.departement d
        JOIN c.region r
        WHERE UPPER(c.nom_commune) LIKE :nameToFind'
    );

$query->setParameter('nameToFind', '%' . $nameToFind . '%');


    $communes = $query->getResult();

    $response = new Response(json_encode($communes));
    $response->headers->set('Content-Type', 'application/json');

    return $response;
   }
}
?>