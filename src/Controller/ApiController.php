<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\partenaire;
use App\Entity\Compte;
use App\Entity\Utilisateurs;
use App\Entity\Profil;

/**
 * @Route("/api")
 */

class ApiController extends AbstractController
{
    /**
     * @Route("/ajoutp",name="ajout",methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function ajoutp(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if (isset($values->nom, $values->rs)) {
            $us = new Partenaire();
            $us->setNom($values->nom);
            $us->setRs($values->rs);
            $us->setNinea($values->ninea);
            $us->setAdresse($values->adresse);
            $entityManager->persist($us);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'Le partenaire  a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Erreur!!'
        ];
        return new JsonResponse($data, 500);
    }

    /**
     * @Route("/new", name="adduser", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $phone = $serializer->deserialize($request->getContent(), Utilisateurs::class, 'json');
        $entityManager->persist($phone);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'le user a bien été ajouté'
        ];
        return new JsonResponse($data, 201);
    }

    // authentification

    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if (isset($values->username, $values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setRoles(['ROLE_ADMIN']);
            $part=$this->getDoctrine()->getRepository(Partenaire::class)->find($values->idpartenaire);
            $user->setIdpartenaire($part);
            $user->setNomcomplet($values->nomcomplet);
            $user->setMail($values->mail);
            $user-> setTel($values->tel);
            $user-> getAdresse($values->adresse);
            $errors = $validator->validate($user);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user=$this->getUser();
        return $this->json([
            'username'=>$user->getUsername(),
            'roles'=>$user->getRoles()
        ]);
    }
    // /** 
    //  * @Route("/ajoutcompte ,name="ajoutcompte", methods={"POST"})
    //  */
    // public function ajoutcompt(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager){
    //     $values = json_decode($request->getContent());
    //     if (isset($values->montant, $values->numbcompte)) {
    //         $compt = new Compte();
    //         $compt->set($values->montant);
    //         $compt->set($values->numbcompte);
    //         $entityManager->persist($compt);
    //         $entityManager->flush();
    //         $data = [
    //             'status' => 201,
    //             'message' => 'bien inserer'
    //         ];
    //         return new JsonResponse($data, 201);
    //     }
    //     $data = [
    //         'status' => 500,
    //         'message' => 'Erreur!!'
    //     ];
    //     return new JsonResponse($data, 500);
    // }
}
