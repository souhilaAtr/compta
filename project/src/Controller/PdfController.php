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
    private function convertPdfToText(string $filePath): string
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);

        return $pdf->getText();
    }

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
        
        // Recherche du numéro de facture dans le texte
        $factureNumber = $this->extractFactureNumber($text);

        // Rendu du texte brut et du numéro de facture en HTML
        return $this->render('pdf/show.html.twig', [
            'html' => nl2br($text),
            'factureNumber' => $factureNumber,
        ]);
    }

    /**
     * Extrait le numéro de facture à partir du texte brut.
     *
     * @param string $text Texte brut extrait du PDF
     *
     * @return string|null Numéro de facture extrait ou null si non trouvé
     */
    private function extractFactureNumber(string $text): ?string
    {
        // Utilisez une expression régulière pour rechercher le numéro de facture
        // Remplacez le motif de l'expression régulière par celui correspondant à votre numéro de facture
        $pattern = '/CENTRAL : (\d+)/i';

        if (preg_match($pattern, $text, $matches)) {
            // Retourne le premier groupe de capture correspondant (le numéro de facture)
            return $matches[1];
        }

        return null;
    }
}
