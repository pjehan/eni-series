<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{

    public function __construct(private string $targetDirectory, private SluggerInterface $slugger)
    {
    }

    public function upload(UploadedFile $file, string $directory = ''): string
    {
        // c:\tmp\Mon Fichier.jpg
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // Mon Fichier
        $safeFilename = $this->slugger->slug($originalFilename);
        // mon-fichier
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        // mon-fichier-g1651grtgrt48rt.jpg

        try {
            $file->move($this->getTargetDirectory() . $directory, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}