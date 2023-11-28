<?php
// src/Service/FactureExtractor.php

namespace App\Service;

class FactureExtractor
{
    /**
     * Extrait diverses informations à partir du texte brut en utilisant différents motifs.
     *
     * @param string $text Texte brut extrait du PDF
     *
     * @return array Résultats de l'extraction
     */
    public function extractInformation(string $text): array
    {
        // Liste des motifs de recherche avec les messages correspondants
        $patterns = [
            'NUMERO' => '/N°(.+)/i',
            'FACTURE_DATE' => '/DU (\d{2}\/\d{2}\/\d{2})/i',
            'REFERENCE_CLIENT' => '/Référence client : (\d{3} \d{3} \d{3})/i',
            'NUMERO_CONTRAT' => '/CONTRAT(.+)/i',
            'LIEU_CONSOMMATION' => '/Lieu de consommation :\s*([\s\S]+?)\s*(?=\w)/i',
            'NOM_CLIENT' => '/MR ([A-Z\s]+)\s*(?=\d)/i',
            'FACTURE_DETAILS' => '/FACTURE(.+)/i', 

            'CONTRAT' => '/CONTRAT(.+)/i', 
            'CLIENT' => '/CLIENT(.+)/i', 
            'TTC' => '/TTC(.+)/i', 
            'TVA' => '/TVA(.+)/i', 
            'PRIX' => '/PRIX(.+)/i',

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

        // Si aucun résultat n'est trouvé, ajouter un résultat par défaut au tableau des résultats
        if (empty($results)) {
            $results[] = [
                'result' => 'Aucune information trouvée.',
                'factureNumber' => null,
            ];
        }

        // Retourner le tableau des résultats
        return $results;
    }
}
