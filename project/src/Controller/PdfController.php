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
               
        // Rendu du texte brut en HTML
        $html = nl2br($text);
    //    if(preg_match('name',$html)){
    //     $facturename = $html->name;
    //    }
        // Affichage de la page HTML résultante
        return $this->render('pdf/show.html.twig', [
            'html' => $html,
            "facturename"   => $facturename
        ]);
    }

    /**
     * Convertir le PDF en texte brut.
     *
     * @param string $filePath Chemin du fichier PDF
     *
     * @return string Texte brut extrait du PDF
     */
    private function convertPdfToText(string $filePath): string
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);

        return $pdf->getText();
    }
}
