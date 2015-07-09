<?php

namespace WebDriverJournal;

class WebDriverProxy
{
    public function __construct($webDriver, $probe)
    {
        $this->webDriver = $webDriver;
        $this->probe = $probe;
    }

    public function __call($methodName, $arguments)
    {
        $this->probe->run();
        $result = call_user_func_array([$this->webDriver, $methodName], $arguments);

        if ($methodName !== 'quit') {
            $this->probe->run();
        }

        return $result;
    }
}
