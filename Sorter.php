<?php

/**
 * Class Sorter
 *
 * Accepts a set of journey steps and outputs the journey in the correct order.
 */

class Sorter
{
    private $data;
    private $to = array();
    private $from = array();
    private $sortedDestinations = array();

    /**
     * Sorter constructor.
     *
     * @param $input
     *
     * Takes in unsorted JSON data and turns it into a PHP array, an example input is {"from":"Tokyo, Japan", "to": "Bangkok, Thailand"}.
     */

    function __construct($input)
    {
        $this->data = json_decode($input, true);
    }

    /**
     * The method that is called to sort the journeys
     *
     * @return array
     */
    public function sortJourneys()
    {
        $this->separateData();
        $this->findOrigin();
        return $this->getSortedDestinations();
    }

    /**
     * A method that separates data into two arrays - $to and $from
     */
    private function separateData()
    {
        foreach ($this->data as $key => $value) {
            array_push($this->from, $value["from"]);
            array_push($this->to, $value["to"]);
        }
    }

    /**
     * A method that finds starting point "from"
     */
    private function findOrigin()
    {
        foreach ($this->data as $value) {
            if (array_search($value["from"], $this->to) === false) {
                array_push($this->sortedDestinations, $value);
                $this->findNext($value);
            }
        }
    }

    /**
     * A method that is called from the findOrigin() method recursively, finding the next locations
     *
     * @param $journey
     */

    private function findNext($journey)
    {
        $index = array_search($journey["to"], $this->from);
        if ($index !== false) {
            $found = $this->data[$index];
            array_push($this->sortedDestinations, $found);
            $this->findNext($found);
        }
    }

    /**
     * A method that creates the list of locations in the correct order from the journey
     *
     * @return array
     */
    private function getSortedDestinations()
    {
        $result = array();
        foreach ($this->sortedDestinations as $destination) {
            array_push($result,
                $destination["from"]);
        }
        if (count($this->sortedDestinations) > 0) {
            $lastJourney = $this->sortedDestinations[count($this->sortedDestinations) - 1];
            array_push($result, $lastJourney["to"]);
        }
        return $result;
    }
}