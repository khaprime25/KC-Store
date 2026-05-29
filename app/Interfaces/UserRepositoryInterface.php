<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function dashboardPage();
    public function shopPage(?int $category_id, ?int $product_id);
    public function shopDetailsPage(int $productVariant_id);
    public function review(array $reviewData);
}
