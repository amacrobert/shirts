<?php

namespace AppBundle\Entity\Media;

class Image {

    private $id;
    private $name;
    private $filename;
    private $caption;
    private $date_created;
    private $date_updated;

    public function __toString() {
        return $this->getName() ?: $this->getFilename() ?: 'New Image';
    }

    public function getId() {
        return $this->id;
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
}
