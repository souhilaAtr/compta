<?php

// src/Controller/OCRController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Process;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends AbstractController
{
    /**
     * @Route("/ocr/upload", name="ocr_upload")
     */
    public function uploadForm()
    {
        return $this->render('ocr/upload.html.twig');
    }

    /**
     * @Route("/ocr/process-file", name="process_file", methods={"POST"})
     */
    public function processFile(Request $request)
    {
        if ($request->files->get('file')) {
            $uploadedFile = $request->files->get('file');
            $text = $this->uploadFile($uploadedFile);

            return $this->render('ocr/show.html.twig', [
                'ocrText' => $text,
            ]);
        }

        // Gérer le cas où aucun fichier n'a été téléchargé
        // Peut-être rediriger vers le formulaire d'importation avec un message d'erreur
    }

    private function uploadFile(UploadedFile $file)
    {
        // Obtient le chemin du fichier PDF uploadé
        $pdfFilePath = $file->getPathname();

        // Obtient le chemin du fichier TIFF de sortie
        $tiffFilePath = $this->convertPdfToTiff($pdfFilePath);

        // Utilise Tesseract OCR pour extraire le texte du fichier TIFF
        $text = $this->runTesseract($tiffFilePath);

        // Supprime le fichier TIFF après utilisation
        unlink($tiffFilePath);

        return $text;
    }

    private function convertPdfToTiff($pdfFilePath)
    {
        // Obtient le chemin du répertoire temporaire
        $tempDir = sys_get_temp_dir();

        // Obtient le chemin du fichier TIFF de sortie
        $tiffFilePath = $tempDir . '/' . uniqid('converted_', true) . '.tiff';

        // Utilise Ghostscript pour convertir le PDF en TIFF
        $process = new Process(['gs', '-sDEVICE=tiff24nc', '-r300', '-o', $tiffFilePath, $pdfFilePath]);
        $process->mustRun();

        return $tiffFilePath;
    }

    private function runTesseract($imageFilePath)
    {
        // Utilise Tesseract OCR pour extraire le texte du fichier TIFF
        $tesseract = new TesseractOCR($imageFilePath);
        $text = $tesseract->run();

        return $text;
    }
}


