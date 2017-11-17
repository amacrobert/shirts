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

        $cache = $this->get('cache');

        if ($cache->contains('product.list')) {
            $products = $cache->fetch('product.list');
        }
        else {
            $products = $this->get('doctrine')->getRepository(Product::class)->findBy(['active' => true], [
                'ordinal' => 'ASC',
                'date_created' => 'DESC',
            ]);

            $cache->save('product.list', $products);

            foreach ($products as $product) {
                $cache->save('product.' . $product->getId(), $product);
            }
        }

        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/p/{product_id}", name="product")
     */
    public function productAction(Request $request) {
        $product_id = $request->get('product_id');

        $cache = $this->get('cache');

        if ($cache->contains('product.' . $product_id)) {
            $product = $cache->fetch('product.' . $product_id);
        }
        else {
            $product = $this->get('doctrine')->getRepository(Product::class)->findOneBy(['id' => $product_id]);

            $cache->save('product.' . $product->getId(), $product);
        }

        return $this->render('default/product.html.twig', ['product' => $product]);
    }
}
