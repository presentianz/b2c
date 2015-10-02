<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;

class LoadCategoryAndProductData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $productid = 0;
        for ($i=0; $i < 4; $i++) {
            $category = new Category();
            $category->setName('分类'.$i);
            $manager->persist($category);
            $parent = $category;
            $product1 = new Product();
            $product2 = new Product();
            $product1->setName('产品'.$productid++);
            $product2->setName('产品'.$productid++);
            $product1->setCategory($category);
            $product2->setCategory($category);
            $manager->persist($product1);
            $manager->persist($product2);

            for ($j=0; $j < 4; $j++) {
                $category = new Category();
                $category->setName('分类'.$i.$j);
                $category->setParent($parent);
                $manager->persist($category);
                $parent = $category;
                $product1 = new Product();
                $product2 = new Product();
                $product1->setName('产品'.$productid++);
                $product2->setName('产品'.$productid++);
                $product1->setCategory($category);
                $product2->setCategory($category);
                $manager->persist($product1);
                $manager->persist($product2);

                for ($k=0; $k < 4; $k++) {
                    $category = new Category();
                    $category->setName('分类'.$i.$j.$k);
                    $category->setParent($parent);
                    $manager->persist($category);
                    $product1 = new Product();
                    $product2 = new Product();
                    $product1->setName('产品'.$productid++);
                    $product2->setName('产品'.$productid++);
                    $product1->setCategory($category);
                    $product2->setCategory($category);
                    $manager->persist($product1);
                    $manager->persist($product2);
                }
            }
        }
        $manager->flush();
    }

}