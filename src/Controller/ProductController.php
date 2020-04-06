<?php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ProductController extends AbstractController
{
	
	protected $NB_PER_PAGE = 6;

	public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

	/**
	 * @Route("/product/{page}", name="product_index", requirements={"page" = "\d+"}, defaults={"page" = 1})
	 */
	public function list_products($page) {

	    $repository = $this->getDoctrine()
	      ->getManager()
	      ->getRepository('App:Product');

	    $listProducts = $repository->getProducts($page, $this->NB_PER_PAGE);
	    $nbPages = ceil(count($listProducts) / $this->NB_PER_PAGE);

	    return $this->render('Product/index.html.twig', array(
	      'listProducts' => $listProducts,
	      'nbPages'     => $nbPages,
	      'page'        => $page,
	      'cardQuantity' => ($this->session->get('card_quantity') > 0) ? $this->session->get('card_quantity') : 0
	    ));
	}



  	/**
	 * @Route("/product/view/{slug}", name="product_view")
	 */
	public function view_product($slug)
	  {

	  	if(empty($slug)) {
		    return $this->redirectToRoute('product_index', array(
		      'listProducts' => $this->listProducts
		    ));
		}

	    $repository = $this->getDoctrine()
	      ->getManager()
	      ->getRepository('App:Product');

	    $product = $repository->findOneBy(array('slug' => $slug));

	    if (null === $product) {
	      throw new NotFoundHttpException("Le produit n'existe pas.");
	    }

	    return $this->render('Product/view.html.twig', array(
	      'product' => $product,
	      'cardQuantity' => ($this->session->get('card_quantity') > 0) ? $this->session->get('card_quantity') : 0
	    ));
	  }



}
