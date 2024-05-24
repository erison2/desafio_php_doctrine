<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Database;

class AuthController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new Database())->getEntityManager();
    }

    public function register($data)
    {
        $user = new User();
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setDocument($data['document']);
        $user->setEmail($data['email']);
        $user->setPhoneNumber($data['phone_number']);
        $user->setBirthDate(new \DateTime($data['birth_date']));
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $user->setPassword($data['password']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function login($email, $password)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return false;
    }

    public function listUsers()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }
}
