<?php

require 'Sorter.php';

use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase
{
    public function testSortRootInMiddle()
    {
        $input = '[{"from":"five", "to": "six"},
	                {"from":"three", "to": "four"},
                    {"from":"one", "to": "two"},
	                {"from":"four", "to": "five"},
                    {"from":"two", "to": "three"}]';

        $output = ["one", "two", "three", "four", "five", "six"];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }

    public function testSortRootFirst()
    {
        $input = '[{"from":"one", "to": "two"},
                    {"from":"five", "to": "six"},
	                {"from":"three", "to": "four"},
	                {"from":"four", "to": "five"},
                    {"from":"two", "to": "three"}]';

        $output = ["one", "two", "three", "four", "five", "six"];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }

    public function testSortRootLast()
    {
        $input = '[{"from":"five", "to": "six"},
	                {"from":"three", "to": "four"},
	                {"from":"four", "to": "five"},
                    {"from":"two", "to": "three"},
                    {"from":"one", "to": "two"}]';

        $output = ["one", "two", "three", "four", "five", "six"];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }

    public function testSortOneEntry()
    {
        $input = '[{"from":"one", "to": "two"}]';

        $output = ["one", "two"];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }

    public function testSortNoEntries()
    {
        $input = '[]';
        $output = [];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }

    public function testSortNoRoot()
    {
        $input = '[{"from":"five", "to": "one"},
	                {"from":"three", "to": "four"},
                    {"from":"one", "to": "two"},
	                {"from":"four", "to": "five"},
                    {"from":"two", "to": "three"}]';

        $output = [];

        $journeySorter = new Sorter($input);
        $result = $journeySorter->sortJourneys();
        $this->assertEquals($output, $result);
    }
}