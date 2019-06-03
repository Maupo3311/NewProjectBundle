<?php

namespace EntityBundle\Repository;

use EntityBundle\Entity\Category;
use EntityBundle\Entity\Shop;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param array $parameters
     * @param null  $availableShops
     * @return QueryBuilder|null
     */
    protected function getBodyQueryByParameters(array $parameters, $availableShops = null)
    {
        $availableCategories = [];

        if ($availableShops === []) {
            return null;
        } elseif (!empty($availableShops)) {

            foreach ($availableShops as $shopData) {
                /** @var Shop $shop */
                $shop = $shopData['shop'];

                foreach ($shop->getCategories() as $category) {
                    $availableCategories[] = $category;
                }
            }
        }

        $query = $this->createQueryBuilder('p')
            ->where("p.title LIKE :search")
            ->andWhere('p.active = 1');

        if (!empty($availableCategories)) {
            $categoryQuery = '';

            /** @var Category $category */
            foreach ($availableCategories as $category) {
                $categoryQuery .= "p.category = {$category->getId()} OR";
            }

            $query->andWhere(substr($categoryQuery, 0, -2));
        }

        if (!empty($parameters['priceForm'])) {
            $query->andWhere("p.price > {$parameters['priceFrom']}");
        }

        if (!empty($parameters['ratingForm'])) {
            $query->andWhere("p.rating > {$parameters['ratingFrom']}");
        }

        if (!empty($parameters['priceTo'])) {
            $query->andWhere("p.price < {$parameters['priceTo']}");
        }

        if (!empty($parameters['ratingTo'])) {
            $query->andWhere("p.rating < {$parameters['ratingTo']}");
        }

        $query->orderBy('p.' . lcfirst($parameters['field']), $parameters['order'])
            ->setParameter('search', "%{$parameters['search']}%");

        return $query;
    }

    /**
     * @return mixed
     */
    public function findBestProducts()
    {
        return $this->createQueryBuilder('p')
            ->where('p.active = 1')
            ->setFirstResult(0)
            ->setMaxResults(10)
            ->orderBy('p.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $parameters
     * @param array $availableShops
     * @return mixed
     */
    public function findByParameters(array $parameters, array $availableShops = null)
    {
        $lastResult  = $parameters['page'] * $parameters['theNumberOnThePage'];
        $firstResult = $lastResult - $parameters['theNumberOnThePage'];

        return $this->getBodyQueryByParameters($parameters, $availableShops)
            ->setFirstResult($firstResult)
            ->setMaxResults($parameters['theNumberOnThePage'])
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array    $parameters
     * @param Category $category
     * @return mixed
     */
    public function findByParametersAndCategory(array $parameters, Category $category)
    {
        return $this->getBodyQueryByParameters($parameters)
            ->andWhere("p.category = {$category->getId()}")
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $parameters
     * @param array $availableShops
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function getQuantityByParameters(array $parameters, array $availableShops = null)
    {
        return $this->getBodyQueryByParameters($parameters, $availableShops)
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param array    $parameters
     * @param Category $category
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function getQuantityByParametersAndCategory(array $parameters, Category $category)
    {
        return $this->getBodyQueryByParameters($parameters)
            ->select('count(p.id)')
            ->andWhere("p.category = {$category->getId()}")
            ->getQuery()
            ->getSingleScalarResult();
    }
}
