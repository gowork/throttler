<?php declare(strict_types=1);

namespace GW\Throttler;

final class Throttler
{
    /** @var float */
    private $throttle;

    /** @var Time */
    private $time;

    /** @var float|null */
    private $nextRun;

    public function __construct(float $throttleSeconds, ?Time $time = null)
    {
        $this->throttle = $throttleSeconds;
        $this->time = $time ?? new Time();
    }

    public static function started(float $throttleSeconds, ?Time $time = null): self
    {
        $self = new self($throttleSeconds, $time);
        $self->progress();

        return $self;
    }

    public function throttle(): void
    {
        if ($this->throttle <= 0.0) {
            return;
        }

        $now = $this->time->now();

        if ($this->nextRun !== null && $this->nextRun > $now) {
            $this->time->sleep($this->nextRun - $now);
        }

        $this->progress();
    }

    public function __invoke(): void
    {
        $this->throttle();
    }

    private function progress(): void
    {
        $this->nextRun = $this->time->now() + $this->throttle;
    }
}
