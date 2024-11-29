<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use App\Repository\ProductRepository; 
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class Search
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $search = '';

    private ProductRepository $productRepository;  

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;  
    }

    public function getProducts(): array
    {
        if ($this->search === '') {
            return $this->productRepository->getAll(); 
        } else {
            return $this->productRepository->findByName($this->search); 
        }
    }
}
