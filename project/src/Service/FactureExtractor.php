<?php
// src/Service/FactureExtractor.php

namespace App\Service;

class FactureExtractor
{
    /**
     * Extrait le numéro de facture à partir du texte brut en utilisant différents motifs.
     *
     * @param string $text Texte brut extrait du PDF
     *
     * @return array Résultat de la comparaison et tableau de numéros de facture extraits
     */
    public function extractFactureNumber(string $text): array
    {
        // Liste des motifs de recherche avec les messages correspondants
        $patterns = [
            'pao' => '/pao : (\w+)/i',
            'tcn' => '/tcn : (\w+)/i',
            'ref' => '/ref : (\w+)/i',
            'distance' => '/distance : (\w+)/i',
            'de' => '/de : (\w+)/i',
            'voiture' => '/voiture (\w+)/i',
            'train' => '/train (\w+)/i',




            // Ajoutez d'autres motifs au besoin
        ];

        // Initialiser le tableau pour stocker les résultats
        $results = [];

        // Parcours des motifs
        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                // Si un motif correspond, extraire les informations et ajouter au tableau des résultats
                $factureNumber = $matches[1];
                $result = "Les données après $key sont : $factureNumber";

                $results[] = [
                    'result' => $result,
                    'factureNumber' => $factureNumber,
                ];
            }
        }

        // Si aucun numéro de facture n'est trouvé, ajouter le résultat par défaut au tableau des résultats
        if (empty($results)) {
            $results[] = [
                'result' => 'Numéro de facture non trouvé.',
                'factureNumber' => null,
            ];
        }

        // Retourner le tableau des résultats
        return $results;
    }
}