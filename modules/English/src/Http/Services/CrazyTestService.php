<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 8/8/18
 * Time: 8:36 PM
 */

namespace English\Http\Services;


use English\Http\Builders\ReadMathCrazyBuilder;
use English\Http\Builders\WriteMathCrazyBuilder;

class CrazyTestService
{
    private WriteMathCrazyBuilder $writeMathCrazyBuilder;
    private ReadMathCrazyBuilder $readMathCrazyBuilder;

    public function __construct(ReadMathCrazyBuilder $readMathCrazyBuilder, WriteMathCrazyBuilder $writeMathCrazyBuilder)
    {
        $this->readMathCrazyBuilder = $readMathCrazyBuilder;
        $this->writeMathCrazyBuilder = $writeMathCrazyBuilder;
    }

    public function reading($id)
    {
        return $this->readMathCrazyBuilder->getThreads($id);
    }

    public function read($id, $sentences, $meanings)
    {
        return $this->readMathCrazyBuilder->done($id, $sentences, $meanings);
    }

    public function writing($id)
    {
        return $this->writeMathCrazyBuilder->getThreads($id);
    }

    public function written($id, $sentences, $meanings)
    {
        return $this->writeMathCrazyBuilder->done($id, $sentences, $meanings);
    }

    public function listening($id)
    {

    }
}
