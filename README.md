# Throttler

[![Build Status](https://travis-ci.org/gowork/throttler.svg?branch=master)](https://travis-ci.org/gowork/throttler)

Use the throttle to control the speed.

```php
use GW\Throttler\Throttler;

$throttler = new Throttler(1.0);

foreach ($heavyTasks->all() as $task) {
    $throttler->throttle(); // wait a second... before next task
    $task->run();
}
```

Alternative usage for wrapping iterables:

```php
use GW\Throttler\Throttler;

$throttledTask = Throttler::iterable($heavyTasks->all(), 1.0);

foreach ($throttledTask as $task) {
    $task->run(); // for each iteration it will sleep one second
}
```
