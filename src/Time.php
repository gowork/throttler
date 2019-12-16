<?php declare(strict_types=1);

namespace GW\Throttler;

use function round;
use function usleep;

class Time
{
    public function now(): float
    {
        return microtime(true);
    }

	public function sleep(float $seconds): void
	{
		$this->uSleep((int)round($seconds * 1000000));
	}

	public function uSleep(int $microseconds): void
	{
		usleep($microseconds);
	}
}
