<?php

namespace App\Services;

abstract class BaseService
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the permissions that users need to execute the service.
     *
     * @return array<string, string>
     */
    public function permissions(): array
    {
        return [];
    }

    /**
     * @param  array<string, string>  $data
     */
    public function valueOrNull(array $data, string $index): ?string
    {
        if (empty($data[$index])) {
            return null;
        }

        return $data[$index] == '' ? null : $data[$index];
    }
}
