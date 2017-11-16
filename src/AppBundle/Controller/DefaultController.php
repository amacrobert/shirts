<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $products = $this->get('doctrine')->getRepository(Product::class)->findBy(['active' => true], [
            'ordinal' => 'ASC',
            'date_created' => 'DESC',
        ]);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/p/{product_id}", name="product")
     */
    public function productAction(Request $request) {
        $product_id = $request->get('product_id');
        $product = $this->get('doctrine')->getRepository(Product::class)->findOneBy(['id' => $product_id]);

        return $this->render('default/product.html.twig', ['product' => $product]);
    }
}
