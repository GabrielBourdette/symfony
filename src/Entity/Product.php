<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

   /**
   * @ORM\Column(name="slug", type="string", length=150)
   */
  protected $slug;

  /**
   * @ORM\Column(name="title", type="string", length=255)
   */
  protected $title;

  /**
   * @ORM\Column(name="price", type="float")
   */
  protected $price;

  /**
   * @ORM\Column(name="description", type="text")
   */
  protected $description;

  /**
   * @ORM\Column(name="img", type="text")
   */
  protected $img;

  public function setSlug($slug) { $this->slug = $slug; }
  public function setTitle($title) { $this->title = $title; }
  public function setPrice($price) { $this->price = $price; }
  public function setDescription($description) { $this->description = $description; }
  public function setImg($img) { $this->img = $img; }

  public function getId() { return $this->id; }
  public function getSlug() { return $this->slug; }
  public function getTitle() { return $this->title; }
  public function getPrice() { return $this->price; }
  public function getDescription() { return $this->description; }
  public function getImg() { return $this->img; }



  public function __construct($slug = "", $title = "", $desc = "", $price = 0, $img = "") {

    $this->setSlug($slug);
    $this->setTitle($title);
    $this->setDescription($desc);
    $this->setPrice($price);
    $this->setImg($img);
  }


}