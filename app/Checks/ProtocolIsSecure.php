<?php

namespace App\Checks;

use BeyondCode\SelfDiagnosis\Checks\Check;

class ProtocolIsSecure implements Check
{
    /**
     * The name of the check.
     *
     * @return string
     */
    public function name(): string
    {
        return 'The protocol must be secured';
    }

    /**
     * Perform the actual verification of this check.
     *
     * @return boolean
     */
    public function check(): bool
    {
        return str_contains('https', config('app.url'));
    }

    /**
     * The error message to display in case the check does not pass.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Please activate SSL to enable secured protocol.';
    }
}
