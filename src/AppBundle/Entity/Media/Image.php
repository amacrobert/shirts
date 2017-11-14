<?php

namespace AppBundle\Entity\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image {

    const SERVER_PATH_TO_IMAGE_FOLDER = __DIR__ . '/../../../../web/img';

    private $id;
    private $name;
    private $filename;
    private $caption;
    private $date_created;
    private $date_updated;

    // unmapped to handle uploads
    private $file;

    public function __toString() {
        return $this->getName() ?: $this->getFilename() ?: 'New Image';
    }

    public function upload() {
        if (!$this->getFile() === null) {
            return;
        }

        $filename = $this->getFile()->getClientOriginalName();
        $this->getFile()->move(self::SERVER_PATH_TO_IMAGE_FOLDER, $filename);
        $this->setFilename($filename);
        $this->setFile(null);
    }

    public function getId() {
        return $this->id;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
        return $this;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function setCaption($caption) {
        $this->caption = $caption;
        return $this;
    }

    public function getDateCreated() {
        return $this->date_created;
    }

    public function setDateCreated($date_created) {
        $this->date_created = $date_created;
        return $this;
    }

    public function getDateUpdated() {
        return $this->date_updated;
    }

    public function setDateUpdated($date_updated) {
        $this->date_updated = $date_updated;
        return $this;
    }

    public function setDateCreatedToNow() {
        return $this->setDateCreated(new \DateTime);
    }

    public function setDateUpdatedToNow() {
        return $this->setDateUpdated(new \DateTime);
    }

    public function lifecycleFileUpload() {
        $this->upload();
    }
}
