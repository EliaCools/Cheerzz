<?php
namespace App\Service;

use App\Entity\ShoppingLine;
use App\Repository\ProductRepository;
use App\Repository\ShoppinglineRepository;
use function PHPUnit\Framework\isNull;


class ShoppingLinePreparer
{
    private ShoppinglineRepository $shoppingLineRepository;
    private ProductRepository $productRepository;

    public function __construct(ShoppingLineRepository $ShoppingLineRepository, ProductRepository $productRepository)
    {

        $this->shoppingLineRepository = $ShoppingLineRepository;
        $this->productRepository = $productRepository;

    }

    public function prepareShoppingLine(int $productId, ?int $shoppingCartId, int  $quantity, bool $isEdit): ShoppingLine
    {

        if($this->shoppingLineRepository->findOneBy(['product'=> $productId, 'shoppingCart'=> $shoppingCartId])){
            $shoppingLine = $this->shoppingLineRepository->findOneBy(['product'=> $productId, 'shoppingCart'=> $shoppingCartId]);
            $current = $shoppingLine->getQuantity();
            $current += $quantity;
            $shoppingLine->setQuantity($current);

            if($isEdit === true){
                $shoppingLine->setQuantity($quantity);
            }

        }else{

            $shoppingLine = new ShoppingLine();
            $shoppingLine->setQuantity($quantity);

        }

        $shoppingLine->setProduct($this->productRepository->findOneBy(['id'=> $productId]));

        return $shoppingLine;
    }



}
