<?php

namespace Frena\Mpesa\Interfaces;

interface BearerRequestBody {

    public function url(): string;

    public function postData(): array;

    public function tokenRequestBody();

}