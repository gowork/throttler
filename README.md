# Throttler

Use the throttle to control the speed.

```php
use GW\Throttler\Throttler;

$throttler = new Throttler(1.0);

foreach ($heavyTasks->all() as $task) {
    $throttler->throttle(); // wait a second... before next task
    $task->run();
}
```
