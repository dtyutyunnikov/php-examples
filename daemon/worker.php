<?php

declare(strict_types=1);

pcntl_async_signals(true);
pcntl_signal(SIGTERM, 'signal_handler');

$instance = getenv('TEST_WORKER');

$needStop = false;
$canStop = false;

$counter = 0;

try {
    echo $instance . ' started.' . \PHP_EOL;

    while (true) {
        $t1 = microtime(true);

        if ($needStop && $canStop) {
            break;
        }

        $counter++;
        if (time() % 30 === 0) {
            echo $instance . ' checkpoint: ' . $counter . \PHP_EOL;
            $counter = 0;
            $canStop = $needStop;
        }

        $tt = microtime(true) - $t1;
        if ($tt < 1) {
            // Если итерация выполняется меньше секунды, запускаем слип до конца секунды
            usleep((int)((1 - $tt) * 1000000));
        }
    }
} catch (\Throwable $e) {
    echo $e->getMessage() . \PHP_EOL;
} finally {
    echo $instance . ' stopped.' . \PHP_EOL;
}

function signal_handler()
{
    global $needStop;

    $needStop = true;

    echo 'Signal received' . \PHP_EOL;
}
