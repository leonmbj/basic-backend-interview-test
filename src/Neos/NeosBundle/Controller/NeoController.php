<?php

namespace Neos\NeosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class NeoController extends Controller
{

    public function hazardousAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $isHazardous = $dm->getRepository('NeosBundle:Neo')->findBy(['is_hazardous' => true]);

        $response = new JsonResponse($this->normalizeData($isHazardous));
        return $response;
    }


    public function fastestAction(Request $request)
    {
        switch ($request->query->get('hazardous')) {
            case "true":
                $hazardous = true;
                break;
            case "false":
            default:
                $hazardous = false;
        }

        $fastest = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('NeosBundle:Neo')
            ->findFastest($hazardous);

        $response = new JsonResponse($this->normalizeData($fastest));
        return $response;
    }


    public function bestYearAction(request $request)
    {
        switch ($request->query->get('hazardous')) {
            case "true":
                $hazardous = true;
                break;
            case "false":
            default:
                $hazardous = false;
        }

        $bestYear = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('NeosBundle:Neo')
            ->findBestYear($this->container, $hazardous);

        if (is_array($bestYear)) {

            $return = [
                'bestYear' => $bestYear[0]['_id']['year'],
                'quantity' => $bestYear[0]['count']
            ];
        } else {
            $return = ['message' => 'Something went wrong. Maybe database is not populated.'];
        }

        $response = new JsonResponse(($return));
        return $response;
    }


    public function bestMonthAction(Request $request)
    {
        switch ($request->query->get('hazardous')) {
            case "true":
                $hazardous = true;
                break;
            case "false":
            default:
                $hazardous = false;
        }

        $bestMonth = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('NeosBundle:Neo')
            ->findBestMonth($this->container, $hazardous);

        if (is_array($bestMonth)) {

            $return = [
                'bestMonth' => $bestMonth[0]['_id']['month'],
                'bestMonthExt' => date('F', mktime(0, 0, 0, $bestMonth[0]['_id']['month'], 10)),
                'quantity' => $bestMonth[0]['count']
            ];
        } else {
            $return = ['message' => 'Something went wrong. Maybe database is not populated.'];
        }

        $response = new JsonResponse(($return));
        return $response;
    }


    public function normalizeData($data)
    {
        $response = [];
        foreach ($data as $item) {
            $response[] = [
                'date' => $item->getDate()->format('Y-m-d'),
                'reference' => $item->getReference(),
                'name' => $item->getName(),
                'speed' => $item->getSpeed(),
                'is_hazardous' => $item->getIsHazardous()
            ];
        }

        return $response;
    }

}
