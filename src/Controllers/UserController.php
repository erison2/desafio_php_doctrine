<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Database;

class UserController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new Database())->getEntityManager();
    }

    // Listagem de todos os usuários
    public function listUsers()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    // Exibição de um único usuário pelo ID
    public function getUser($id)
    {
        return $this->entityManager->find(User::class, $id);
    }

    // Criação de um novo usuário
    public function createUser($data)
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
        $user->setPassword($data['password']); // Usa o método setPassword()

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    // Atualização de um usuário existente
    public function updateUser($id, $data)
    {
        // Busca o usuário pelo ID
        $user = $this->entityManager->find(User::class, $id);

        if ($user) {
            // Atualiza os campos do usuário
            $user->setFirstName($data['first_name']);
            $user->setLastName($data['last_name']);
            $user->setDocument($data['document']);
            $user->setEmail($data['email']);
            $user->setPhoneNumber($data['phone_number']);
            $user->setBirthDate(new \DateTime($data['birth_date']));
            $user->setUpdatedAt(new \DateTime());

            // Atualiza a senha somente se uma nova senha for fornecida
            if (!empty($data['password'])) {
                $user->setPassword($data['password']);
            }

            // Salva as alterações no banco de dados
            $this->entityManager->flush();

            return $user;
        }

        return null;
    }

    // Exclusão de um usuário pelo ID
    public function deleteUser($id)
    {
        $user = $this->entityManager->find(User::class, $id);

        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            return true;
        }

        return false;
    }
}
