<?php

namespace AppBundle\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;

class Product {

    private $id;
    private $active = false;
    private $name;
    private $link;
    private $price;
    private $sex;
    private $description;
    private $ordinal = 0;
    private $featured_image;
    private $product_images;
    private $date_created;

    public function jsonSerialize() {
        return [
            'id'                => $this->getId(),
            'active'            => $this->isActive(),
            'name'              => $this->getName(),
            'link'              => $this->getLink(),
            'price'             => $this->getPrice(),
            'sex'               => $this->getSex(),
            'description'       => $this->getDescription(),
            'ordinal'           => $this->getOrdinal(),
            'featured_image'    => $this->getFeaturedImage(),
        ];
    }

    public function __contruct() {
        $this->product_images = new ArrayCollection;
    }

    public function __toString() {
        return $this->getName() ?: 'New Product';
    }

    public function getId() {
        return $this->id;
    }

    public function isActive() {
        return (boolean)$this->active;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getOrdinal() {
        return $this->ordinal;
    }

    public function setOrdinal($ordinal) {
        $this->ordinal = $ordinal;
        return $this;
    }

    public function getFeaturedImage() {
        return $this->featured_image;
    }

    public function setFeaturedImage($image) {
        $this->featured_image = $image;
        return $this;
    }

    public function getProductImages() {
        return $this->product_images;
    }

    public function addProductImage($product_image) {
        $product_image->setProduct($this);
        $this->product_images[] = $product_image;
        return $this;
    }

    public function removeProductImage($product_image) {
        $product_image->setProduct(null);
        $this->product_images->removeElement($product_image);
        return $this;
    }

    public function getDateCreated() {
        return $this->date_created;
    }

    public function setDateCreated($date) {
        $this->date_created = $date;
        return $this;
    }

    public function setDateCreatedToNow() {
        return $this->setDateCreated(new \DateTime);
    }

}
