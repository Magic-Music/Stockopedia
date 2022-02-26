<?php

namespace App\Interfaces;

interface SecuritiesRepositoryInterface
{
    public function getAttributeValueForSecurity(string $securitySymbol, string $attributeName);
}
