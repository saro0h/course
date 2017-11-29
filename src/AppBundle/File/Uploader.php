<?php

namespace AppBundle\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Psr\Log\LoggerInterface;

class Uploader
{
    private $logger;

    private $pathToUploadFolder;

    private $absolutePathWebFolder;

    public function __construct(LoggerInterface $logger, $absolutePathWebFolder, $pathToUploadFolder)
    {
        $this->logger = $logger;
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

        $this->logger->notice(
            sprintf('The file %s have been moved successfully to the folder %s.', $filename, $path)
        );

        return $this->pathToUploadFolder.'/'. $filename;
    }
}
