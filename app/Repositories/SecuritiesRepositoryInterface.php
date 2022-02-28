<?php

namespace App\Repositories;

interface SecuritiesRepositoryInterface
{
    public function getAttributeValueForSecurity(string $securitySymbol, string $attributeName);
}
