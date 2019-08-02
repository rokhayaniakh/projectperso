<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
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
use App\Form\PartenaireType;
use App\Repository\UserRepository;

/**
 * @Route("/controller")
 */
class SuperadminController extends AbstractController
{
    /**
     * @Route("/superadmin", name="superadmin" , methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */

    public function superadmin(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if (isset($values->username, $values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            // $user->setRoles($user->getRoles());
            $user->setRoles(['ROLE_CAISSIER']);
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
}
