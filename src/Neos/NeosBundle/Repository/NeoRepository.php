<?php namespace Neos\NeosBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class NeoRepository extends DocumentRepository
{
    public function findFastest($is_hazardous)
    {
        return $this->createQueryBuilder()
            ->field('is_hazardous')->equals($is_hazardous)
            ->sort('speed', 'DESC')
            ->limit(1)
            ->getQuery()
            ->execute();
    }

    public function findBestYear($container, $is_hazardous)
    {
        $expr = new \Solution\MongoAggregation\Pipeline\Operators\Expr;

        $aq = $container
            ->get('doctrine_mongodb.odm.default_aggregation_query')
            ->getCollection('NeosBundle:Neo')
            ->createAggregateQuery()
            ->match(['is_hazardous' => $is_hazardous])
            ->group(['_id' => [
                'year' => $expr->year('$date')
            ],
                'count' => $expr->sum(1)])
            ->getQuery()->getPipeline();

        return $container
            ->get('doctrine_mongodb.odm.document_manager')
            ->getDocumentCollection('NeosBundle:Neo')
            ->aggregate($aq)
            ->toArray();
    }

    public function findBestMonth($container, $is_hazardous)
    {
        $expr = new \Solution\MongoAggregation\Pipeline\Operators\Expr;

        $aq = $container
            ->get('doctrine_mongodb.odm.default_aggregation_query')
            ->getCollection('NeosBundle:Neo')
            ->createAggregateQuery()
            ->match(['is_hazardous' => $is_hazardous])
            ->group(['_id' => [
                'month' => $expr->month('$date')
            ],
                'count' => $expr->sum(1)])
            ->getQuery()->getPipeline();

        return $container
            ->get('doctrine_mongodb.odm.document_manager')
            ->getDocumentCollection('NeosBundle:Neo')
            ->aggregate($aq)
            ->toArray();
    }
}