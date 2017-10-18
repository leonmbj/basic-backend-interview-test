<?php

namespace Neos\NeosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Unirest;
use Neos\NeosBundle\Document\Neo;

class NeosFetchDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('neos:fetch-data')
            ->setDescription('Fetch data from NEOS Api')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');


        $start_date = date("Y-m-d", strtotime("-3 day"));
        $end_date = date("Y-m-d", strtotime("-1 day"));

        // Search NEOs
        $headers = array('Accept' => 'application/json');
        $query = array(
            'api_key' => 'N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD', 
            'start_date' => $start_date,
            'end_date' => $end_date,
        );
        $response = Unirest\Request::get('https://api.nasa.gov/neo/rest/v1/feed', $headers, $query);

        if ($response->code === 200) {

            $counter = 0;
            $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
            $data = json_decode($response->raw_body);

            $elements = $data->element_count;
            $neos = $data->near_earth_objects;

            foreach ($neos as $neo_date => $neo_data) {

                foreach ($neo_data as $neo_item) {
                    $exists = $dm->getRepository('NeosBundle:Neo')->findOneByReference((int) $neo_item->neo_reference_id);

                    if(!$exists) {
                        $neo = new Neo();
                        $neo->setDate($neo_date);
                        $neo->setName($neo_item->name);
                        $neo->setReference($neo_item->neo_reference_id);
                        $neo->setSpeed($neo_item->close_approach_data[0]->relative_velocity->kilometers_per_hour);
                        $neo->setIsHazardous($neo_item->is_potentially_hazardous_asteroid);
                        $dm->persist($neo);
                        $counter++;
                    }
                }
            }

            $output->writeln("$counter objects were imported from Nasa Database");

            $dm->flush();
            
        } else {
            $output->writeln('An error occoured while fetching data from Nasa');
        }
    }

}
