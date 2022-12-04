<?php

namespace Sandbox;

trait AppTrait
{
    abstract protected function init($args = []);

    abstract protected function main();

    /**
     * @param array $args
     */
    public function run(array $args = [])
    {
        $this->init($args);

        try {
            $this->main();
        } catch (Exception $e) {
            $this->log($e->getMessage(), LOG_ERR);
        }
    }

    /**
     * @param string $message
     * @param int $priority (@see LOG_* constants)
     */
    private function log($message, $priority = LOG_NOTICE)
    {
        openlog(self::SCRIPT_NAME, LOG_PID | LOG_PERROR, LOG_USER);
        syslog($priority, $message);
        closelog();
    }
}
