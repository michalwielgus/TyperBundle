<?php

namespace Acme\TyperBundle\Controller;
use Acme\TyperBundle\Entity\Mecz;
use Acme\TyperBundle\Entity\User;
use Acme\TyperBundle\Entity\Kupony;
use Acme\TyperBundle\Entity\Typy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Acme\TyperBundle\Entity\Formularz;



class DefaultController extends Controller
{
    public function indexAction()
    {
        $mecz = new Mecz();
        $repository = $this->getDoctrine()->getRepository('AcmeTyperBundle:Mecz');
        
        $query = $repository->createQueryBuilder('p')
                ->where('p.data> CURRENT_TIMESTAMP()')
                ->orderBy('p.data', 'ASC')
                ->setMaxResults(5)
                ->getQuery();
        
        $mecz = $query->getResult();
        $user = $this->get('security.context')->getToken()->getUser()->getUsername();
        $id = $this->get('security.context')->getToken()->getUser()->getId();
        return $this->render('AcmeTyperBundle:Default:index.html.twig', array('mecz'=>$mecz, 'user'=>$user, 'id'=>$id));
    }
    
    public function loginAction(Request $request) {
        
         $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'AcmeTyperBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    
    public function userAction($name)
    {
    $user = new User();
          $user->setUsername($name);
          $user->setEmail('michalwiel@o2.pl');
          $user->setSalt(md5(time()));
          $user->setIsActive(false);

          $encoder = new MessageDigestPasswordEncoder('sha512',true,1);
          $password = $encoder->encodePassword('1234', $user->getSalt());
          $user->setPassword($password);
          $manager = $this->getDoctrine()->getManager();
          $manager->persist($user);

          $manager->flush();  

        return $this->render('AcmeTyperBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function nowykuponAction($id, $kwota) {
        $kupon = new Kupony();
        $kupon->setIdUzytkownika($id);
        $kupon->setStatus('Oczekujący');
        $kupon->setStawka($kwota);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($kupon);
        
        $manager->flush();
        
        $id_kuponu = $kupon->getId();
        return $this->redirect($this->generateUrl('kupon_edycja', array('id_kuponu' => $id_kuponu)));
    }
    
    public function kuponedycjaAction($id_kuponu) {
        $mecz = new Mecz();
        $repository = $this->getDoctrine()->getRepository('AcmeTyperBundle:Mecz');
        
        $query = $repository->createQueryBuilder('p')
                ->where('p.data> CURRENT_TIMESTAMP()')
                ->orderBy('p.data', 'ASC')
                ->setMaxResults(5)
                ->getQuery();
        
        $mecz = $query->getResult();
        $user = $this->get('security.context')->getToken()->getUser()->getUsername();
        $id = $this->get('security.context')->getToken()->getUser()->getId();
        
        $dodane = new Typy();
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        '  SELECT t, m FROM AcmeTyperBundle:Typy t
            JOIN t.meczid m
            WHERE t.id_kuponu = '.$id_kuponu);

        $dodane = $query->getResult();
        return $this->render('AcmeTyperBundle:Default:edycja.html.twig', array('mecz'=>$mecz, 'user'=>$user, 'id_kuponu'=>$id_kuponu, 'dodane'=>$dodane));       
    }
    
    public function dodajtypAction($id_kuponu, $id_meczu, $typ) {
        
        $dodane = new Typy();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT t FROM AcmeTyperBundle:Typy t WHERE t.id_meczu='.$id_meczu.' AND t.id_kuponu='.$id_kuponu);

        $dodane = $query->getResult();
        
        if($dodane){
 
                    return $this->render('AcmeTyperBundle:Default:alert.html.twig', array('id_kuponu'=>$id_kuponu));       

   
            
        }
        else {
           $et = $this->getDoctrine()->getManager();
           $selektor ="typ".$typ;
           $emm = $this->getDoctrine()->getManager();
           $stawka = $emm->createQuery('SELECT m.typ'.$typ.' FROM AcmeTyperBundle:Mecz m WHERE m = '.$id_meczu)->getResult();
           $stawka = $stawka[0][$selektor];
           $meczs = new Mecz();
           $meczs = $em->getRepository('AcmeTyperBundle:Mecz')->find($id_meczu);
       
            $typs = new Typy();
            $typs->setIdKuponu($id_kuponu);
            $typs->setMeczid($meczs);
            $typs->setTyp($typ);           
            $typs->setStawka($stawka);
            
            $et->persist($typs);
            $et->flush();
        }
        
        return $this->redirect($this->generateUrl('kupon_edycja', array('id_kuponu' => $id_kuponu)));
        
    }
    
    public function mojekuponyAction($id) {
        $kupony = new Kupony();
        $repository = $this->getDoctrine()->getRepository('AcmeTyperBundle:Kupony');
        
        $query = $repository->createQueryBuilder('k')
                ->where('k.id_uzytkownika = '.$id)
                ->getQuery();
        
        $kupony = $query->getResult();
        return $this->render('AcmeTyperBundle:Default:mojekupony.html.twig', array('kupony' => $kupony));

    }
    
    public function kuponsprawdzAction($id) {
        $dodane = new Typy();
        $repository = $this->getDoctrine()->getRepository('AcmeTyperBundle:Typy');
        
        $query = $repository->createQueryBuilder('t')
                ->where('t.id_kuponu='.$id)
                ->getQuery();
        
        $dodane = $query->getResult();
        
        
       
        
        $poprawne = new Typy();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        "SELECT t, m FROM AcmeTyperBundle:Typy t
            JOIN t.meczid m
            WHERE t.typ LIKE CONCAT(m.wyniktyp,'%')   AND t.id_kuponu=".$id." AND m.data < CURRENT_TIMESTAMP()");

        $poprawne = $query->getResult();
        
        $niepoprawne = new Typy();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        "SELECT t, m FROM AcmeTyperBundle:Typy t
            JOIN t.meczid m
            WHERE t.typ  NOT LIKE CONCAT(m.wyniktyp,'%')   AND t.id_kuponu=".$id." AND m.data < CURRENT_TIMESTAMP()");

        $niepoprawne = $query->getResult();
        
        $nierozegrane = new Typy();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        "SELECT t, m FROM AcmeTyperBundle:Typy t
            JOIN t.meczid m
            WHERE m.data > CURRENT_TIMESTAMP() AND t.id_kuponu=".$id);

        $nierozegrane = $query->getResult();
        
        $kupon = new Kupony();
        $kupon = $em->getRepository('AcmeTyperBundle:Kupony')->find($id);
        
        $stawka = $em->createQuery('SELECT k.stawka FROM AcmeTyperBundle:Kupony k WHERE k.id='.$id)->getResult();
            $stawka = $stawka[0]['stawka'];
            $kurs = $stawka;
            
        if(!$niepoprawne && !$nierozegrane) {
            $komunikat = "Gratulacje, wygrałeś!";
            $em = $this->getDoctrine()->getManager();
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                        '  SELECT COUNT(t.id) FROM AcmeTyperBundle:Typy t
                       
                          WHERE t.id_kuponu = '.$id);
            $total = $query->getResult();
            $total = $total[0][1];
            
            $stawki = $em->createQuery('SELECT t.stawka FROM AcmeTyperBundle:Typy t
                          WHERE t.id_kuponu = '.$id)->getResult();
      
            for($i=0; $i<$total;  $i++) {
                 $kurs =  $kurs*$stawki[$i]['stawka'];
                 
            }
            
            $kupon->setStatus('Wygrany');
            
        }
        
        else if(!$nierozegrane) {
            $komunikat = "Niestety nie wygrałeś!";
            $kupon->setStatus('Niewygrany');
            $kurs = 0;
        }
        
        else {
            $komunikat = "Nie wszystkie mecze zostały jeszcze rozegrane, sprawdź później.";
            $kurs = 0;
            
        }
        $em->flush();
        
        return $this->render('AcmeTyperBundle:Default:kuponsprawdz.html.twig', array('poprawne' => $poprawne, 'dodane' =>  $dodane, 'niepoprawne' => $niepoprawne, 'nierozegrane' => $nierozegrane, 'komunikat' => $komunikat, 'stawka'=>$stawka, 'kurs'=>$kurs));
    }
    
    public function ustawstawkeAction(Request $request, $id){
        $formularz = new Formularz();
     

        $formularz = $this->createFormBuilder($formularz)
            ->add('kwota', 'text')
                ->getForm();
        
                  $formularz->handleRequest($request);

                    if ($formularz->isValid()) {
                        $kwota = $formularz["kwota"]->getData();

                        return $this->redirect($this->generateUrl('dodaj_kupon', array('id' => $id, 'kwota'=> $kwota)));   
                    }

        return $this->render('AcmeTyperBundle:Default:formularz.html.twig', array(
            'formularz' => $formularz->createView(), 'id'=>$id
        ));
    }
}