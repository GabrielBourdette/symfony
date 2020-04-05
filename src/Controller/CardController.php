<?php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CardController extends AbstractController
{
	
	protected $total;
	protected $listProducts;
	protected $listProducts_qt;

	public function __construct(SessionInterface $session) {

		$this->total = 0;
		$this->listProducts = array();
		$this->cardQuantity = 0;
		$this->session = $session;
	}


	/**
	 * @Route("/card", name="card_index")
	 */
	public function card_view() {


	   	$session_list = is_array($this->session->get('products_list')) ? $this->session->get('products_list') : array() ;
	   	$products_quantities = array();

	   	if(count($session_list) >= 1) {
		   	foreach ($session_list as $product_id => $product_qt) {

		   		$new_product = $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('App:Product')
			      ->find($product_id);

			    $this->listProducts[] = $new_product;
			    $products_quantities[$product_id] = $product_qt;
			    $this->total += $new_product->getPrice() * $product_qt;
			    $this->cardQuantity += $product_qt;
		   	}
		}

	   	$this->session->set('card_quantity',$this->cardQuantity);

	    return $this->render('Card/card.html.twig', array(
	      'listProducts' => $this->listProducts,
	      'productsQuantities' => $products_quantities,
	      'cardTotal' => $this->total,
	      'cardQuantity' => $this->session->get('card_quantity')
	    ));
	}


	/**
   	 * @Route("/card/add/{id_product}", name="add_to_card")
   	 */
	public function card_add($id_product) {

	   	$session_list = $this->session->get('products_list');
	   	$product_qt = isset($_GET['product_qt']) ? $_GET['product_qt'] : 1;
	   	$session_list[$id_product] = (isset($session_list[$id_product]) ? $session_list[$id_product] : 0) + $product_qt;

	    $this->session->set('products_list', $session_list);
	    $this->session->set('card_quantity', $this->session->get('card_quantity') + $product_qt);

	    $this->session->getFlashBag()->add('infos', 'Produit ajouté au panier !');
	    return $this->redirectToRoute('card_index', array(
	      'listProducts' => $this->listProducts
	    ));
	}


	/**
   	 * @Route("/card/one_more/{id_product}", name="card_one_more")
   	 */
	public function card_one_more($id_product) {

	   	$session_list = $this->session->get('products_list');
	   	$session_list[$id_product] = $session_list[$id_product] + 1;

	    $this->session->set('products_list', $session_list);
	    $this->session->set('card_quantity', $this->session->get('card_quantity') + 1);

	    $this->session->getFlashBag()->add('infos', 'Produit ajouté au panier !');
	    return $this->redirectToRoute('card_index', array(
	      'listProducts' => $this->listProducts
	    ));
	}


	/**
   	 * @Route("/card/one_less/{id_product}", name="card_one_less")
   	 */
	public function card_one_less($id_product) {

	   	$session_list = $this->session->get('products_list');
	   	$session_list[$id_product] = $session_list[$id_product] - 1;

	    $this->session->set('products_list', $session_list);
	    $this->session->set('card_quantity', $this->session->get('card_quantity') - 1);

	    $this->session->getFlashBag()->add('infos', 'Produit retiré du panier !');
	    return $this->redirectToRoute('card_index', array(
	      'listProducts' => $this->listProducts
	    ));
	}


	/**
   	 * @Route("/card/remove/{id_product}", name="card_remove_one")
   	 */
	public function card_remove_one($id_product) {

	   	$session_list = $this->session->get('products_list');
	   	$previous_qt = $session_list[$id_product];
	   	unset($session_list[$id_product]);

	    $this->session->set('products_list', $session_list);
	    $this->session->set('card_quantity', $this->session->get('card_quantity') - $previous_qt);

	    $this->session->getFlashBag()->add('infos', 'Produit retiré du panier !');
	    return $this->redirectToRoute('card_index', array(
	      'listProducts' => $this->listProducts
	    ));
	}


	/**
   	 * @Route("/card/remove_all", name="empty_card")
   	 */
	public function card_delete() {

	    $this->session->set('products_list', array());
	    $this->session->set('card_quantity', 0);

	    $this->session->getFlashBag()->add('infos', 'Panier vide !');
	    return $this->redirectToRoute('card_index', array(
	      'listProducts' => $this->listProducts,
	      'cardQuantity' => count($this->session->get('products_list'))
	    ));
	}



}