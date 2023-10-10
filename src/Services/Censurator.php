<?php

namespace App\Services;

class Censurator
{

    const GROS_MOTS = ["caca", "pipi", "prout"];

    // Remplace les gros mots par des *****
    public function purify(string $texte): string
    {
//        return str_replace(self::GROS_MOTS, "***", $texte);
        foreach (self::GROS_MOTS as $mot) {
            $texte = str_ireplace($mot, str_repeat('*', strlen($mot)), $texte);
        }
        return $texte;
    }

}