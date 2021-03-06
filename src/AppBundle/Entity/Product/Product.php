<?php

namespace AppBundle\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Product {

    private $id;
    private $active = false;
    private $name;
    private $link;
    private $price;
    private $sex;
    private $type;
    private $description;
    private $ordinal = 0;
    private $product_images;
    private $date_created;
    private $open_graph_image;

    public function __construct() {
        $this->product_images = new ArrayCollection;
    }

    public function __toString() {
        return $this->getName() ?: 'New Product';
    }

    public function getId() {
        return $this->id;
    }

    public function getOpenGraphImage() {
        return $this->open_graph_image;
    }

    public function setOpenGraphImage($image) {
        $this->open_graph_image = $image;
        return $this;
    }

    public function getFullName() {
        return ($this->getSex() ? ucwords($this->getSex()) . '\'s ' : '') . $this->getName();
    }

    public function getUrl() {
        return 'http://shirtsforphotographers.com/p/' . $this->getId();
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

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
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
        return $this->getProductImages()->first();
    }

    public function getProductImages() {
        // fetch EAGER does not support orderBy, so ordering product images must be done here
        $criteria = Criteria::create()->orderBy(['ordinal' => Criteria::ASC]);

        return $this->product_images->matching($criteria);
    }

    public function addProductImage($product_image) {
        $product_image->setProduct($this);
        $this->product_images->add($product_image);
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
