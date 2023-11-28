<?php

// src/Controller/PdfController.php

namespace App\Controller;

use Smalot\PdfParser\Parser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    /**
     * @Route("/upload-pdf", name="upload_pdf")
     */
    public function uploadPdf(Request $request): Response
    {
        // Récupération du fichier PDF soumis via le formulaire
        $file = $request->files->get('pdf_file');

        // Vérifier si un fichier a été soumis
        if (!$file) {
            // Rendre le formulaire initial si aucun fichier n'a été soumis
            return $this->render('pdf/upload.html.twig');
        }

        // Vérifier si le fichier est bien un fichier PDF
        if ($file->getMimeType() !== 'application/pdf') {
            // Gérer le cas où un fichier non PDF est soumis
            return new Response('Veuillez soumettre un fichier PDF valide.');
        }

        // Chemin où sauvegarder le fichier temporairement
        $filePath = $file->getPathname();

        // Conversion du PDF en texte brut
        $text = $this->convertPdfToText($filePath);

        // Définir la chaîne à comparer
        $nomfac = "REF";

        // Recherche du numéro de facture dans le texte
        $result = $this->extractFactureNumber($text, $nomfac);

        // Rendu du texte brut et du résultat de la comparaison en HTML
        return $this->render('pdf/show.html.twig', [
            'html' => nl2br($text),
            'result' => $result['result'],
            'factureNumber' => $result['factureNumber'],
        ]);
    }

    /**
     * Extrait le numéro de facture à partir du texte brut.
     *
     * @param string $text Texte brut extrait du PDF
     * @param string $nomfac Chaîne à comparer
     *
     * @return array Résultat de la comparaison et numéro de facture extrait
     */
    private function extractFactureNumber(string $text, string $nomfac): array
    {
        // Utilisez une expression régulière pour rechercher le numéro de facture
        // Remplacez le motif de l'expression régulière par celui correspondant à votre numéro de facture
        $pattern = '/TCN : (\w+)/i';

        // Initialiser le résultat de la comparaison
        $result = '';

        if (preg_match($pattern, $text, $matches)) {
            // Extraire le numéro de facture
            $factureNumber = $matches[1];

            // Comparer avec la chaîne prédéfinie
            if ($nomfac === "REF") {
                $result = 'Les chaînes sont identiques!';
            } else {
                $result = 'Les chaînes ne sont pas identiques.';
            }

            // Retourner le résultat de la comparaison et le numéro de facture extrait
            return [
                'result' => $result,
                'factureNumber' => $factureNumber,
            ];
        }

        // Si aucun numéro de facture n'est trouvé, retourner un tableau avec le résultat par défaut
        return [
            'result' => 'Numéro de facture non trouvé.',
            'factureNumber' => null,
        ];
    }

    /**
     * Convertit un fichier PDF en texte brut.
     *
     * @param string $filePath Chemin du fichier PDF
     *
     * @return string Texte brut extrait du PDF
     */
    private function convertPdfToText(string $filePath): string
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($filePath);

        return $pdf->getText();
    }
}
