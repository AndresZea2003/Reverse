<?php

namespace App\Contracts;
interface WebcheckoutContract
{
    public function getInformation(?int $session_id);
    public function createSession(array $data);
    public function information(array $data);
    public function process(array $data);
    public function transaction(array $data);
}
