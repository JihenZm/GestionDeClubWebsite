<?php

namespace App\Service;

class PasswordGenerator
{
    public function generatePassword(int $length = 12): string
    {
        // Votre logique de génération de mot de passe ici
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[mt_rand(0, $max)];
        }

        return $password;
    }
}
?>