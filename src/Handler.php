<?php
namespace MonologRethinkDBHandler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use r;

class Handler extends AbstractProcessingHandler
{
    /** @var string */
    private $durability;

    /** @var r\Connection */
    private $connection;

    public function __construct($level = Logger::DEBUG, $bubble = true, r\Connection $connection, $table, $durability = 'soft')
    {
        parent::__construct($level, $bubble);
        $this->connection = $connection;
        $this->durability = $durability;
    }

    public function handle(array $record)
    {
        $this->write($record);

        return false === $this->bubble;
    }

    protected function write(array $record)
    {
        unset($record['level_name']);
        if (array() === $record['extra']) {
            unset($record['extra']);
        }

        /** @var \DateTime $datetime */
        $datetime = $record['datetime'];
        $rDatetime = r\epochTime($datetime->getTimestamp());

        $record['datetime'] = $rDatetime;

        //$result =
        r\table("log")->insert($record, ['durability' => 'soft'])->run($this->connection, ['noreply' => true]);
//        echo "Insert: $result\n";
    }
}

