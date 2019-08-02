<?php

namespace App\Controller;

use App\Entity\User;
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
            $use = new User();
            $use->setUsername($values->username);
            $use->setPassword($passwordEncoder->encodePassword($use, $values->password));
            $use->setRoles(['ROLE_CAISSIER']);
            $part = $this->getDoctrine()->getRepository(Partenaire::class)->find($values->idpartenaire);
            $use->setIdpartenaire($part);
            $use->setNomcomplet($values->nomcomplet);
            $use->setMail($values->mail);
            $use->setTel($values->tel);
            $use->getAdresse($values->adresse);
            $errors = $validator->validate($use);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($use);
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
}
