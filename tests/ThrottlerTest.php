<?php declare(strict_types=1);

namespace tests\GW\Throttler;

use GW\Throttler\Throttler;
use PHPUnit\Framework\TestCase;
use function microtime;

final class ThrottlerTest extends TestCase
{
    function test_throttling_system_time()
    {
        $throttler = new Throttler(0.1);
        $start = microtime(true);

        // first throttle is a warm-up
        $throttler->throttle();
        $lapTime = microtime(true) - $start;
        self::assertLessThan(0.1, $lapTime);

        // next calls should be throttled
        $throttler->throttle();
        $lapTime = microtime(true) - $start;
        self::assertGreaterThanOrEqual(0.1, $lapTime);
        self::assertLessThan(0.2, $lapTime);

        $throttler();
        $lapTime = microtime(true) - $start;
        self::assertGreaterThanOrEqual(0.2, $lapTime);
        self::assertLessThan(0.3, $lapTime);
    }

    function test_throttling_system_time_from_the_start()
    {
        $throttler = Throttler::started(0.1);
        $start = microtime(true);

        // next calls should be throttled
        $throttler->throttle();
        $lapTime = microtime(true) - $start;
        self::assertGreaterThanOrEqual(0.1, $lapTime);
        self::assertLessThan(0.2, $lapTime);

        $throttler();
        $lapTime = microtime(true) - $start;
        self::assertGreaterThanOrEqual(0.2, $lapTime);
        self::assertLessThan(0.3, $lapTime);
    }
}
