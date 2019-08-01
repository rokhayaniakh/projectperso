<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Partenaire;
use App\Entity\Compte;
use App\Entity\Depot;
use App\Entity\Profil;
use Symfony\Component\HttpFoundation\Response;
use App\Form\PartenaireType;

/**
 * @Route("/api")
 */

class ApiController extends AbstractController
{
    /**
     * @Route("/ajoutp",name="ajout",methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
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
    // authentification

    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if (isset($values->username, $values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setRoles($user->getRoles());
            // $user->setRoles(['ROLE_SUPER_ADMIN']);
            $part = $this->getDoctrine()->getRepository(Partenaire::class)->find($values->idpartenaire);
            $user->setIdpartenaire($part);
            $user->setNomcomplet($values->nomcomplet);
            $user->setMail($values->mail);
            $user->setTel($values->tel);
            $user->getAdresse($values->adresse);
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
            'message' => 'Erreur'
        ];
        return new JsonResponse($data, 500);
    }
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
    /** 
     * @Route("/depot" , name="depot", methods={"POST"})
     * @IsGranted("ROLE_CAISSIER")
     */
    public function depot(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if (isset($values->montant)) {
            $compt = new Depot();
            $compt->setMontant($values->montant);
            $compt->setDate(new \DateTime());
            $rec = $this->getDoctrine()->getRepository(Compte::class)->find($values->idcompte);
            $compt->setIdcompte($rec);
            $rec->setSolde($rec->getSolde() + $values->montant);
            $errors = $validator->validate($compt);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($compt);
            $entityManager->flush();
            $data = [
                'status' => 201,
                'message' => 'depot reussie'
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Erreur'
        ];
        return new JsonResponse($data, 500);
    }
    // update
    /**
     * @Route("/partenaire/{id}", name="update_phone", methods={"PUT"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function update(Request $request, SerializerInterface $serializer, Partenaire $partenaire, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $phoneUpdate = $entityManager->getRepository(Partenaire::class)->find($partenaire->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $value) {
            if ($key && !empty($value)) {
                $name = ucfirst($key);
                $setter = 'set' . $name;
                $phoneUpdate->$setter($value);
            }
        }
        $errors = $validator->validate($phoneUpdate);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Le partenaire a bien été mis à jour'
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/show/{id}", name="show_partenaire", methods={"GET"})
     */
    public function show(Partenaire $partenaire, PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
        $partenaire = $partenaireRepository->find($partenaire->getId());
        $data = $serializer->serialize($partenaire, 'json', [
            'groups' => ['show']
        ]);
        //var_dump($partenaire);
        var_dump($data);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
