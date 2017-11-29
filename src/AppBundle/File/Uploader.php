<?php

namespace AppBundle\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    private $pathToUploadFolder;

    private $absolutePathWebFolder;

    public function __construct($absolutePathWebFolder, $pathToUploadFolder)
    {
        $this->absolutePathWebFolder = $absolutePathWebFolder;
        $this->pathToUploadFolder = $pathToUploadFolder;
    }

    /**
     * This method receives a UploadedFile object, move the file to the right
     * directory and returns the path to this file moved.
     */
    public function upload(UploadedFile $file)
    {
        $filename = time().'-'.$file->getClientOriginalName();

        $path = $this->absolutePathWebFolder.$this->pathToUploadFolder;
        $file->move($path, $filename);

        return $this->pathToUploadFolder.'/'. $filename;
    }
}
