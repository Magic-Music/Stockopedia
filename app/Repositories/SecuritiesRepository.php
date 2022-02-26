<?php

namespace App\Repositories;

use App\Interfaces\SecuritiesRepositoryInterface;
use App\Models\Security;

class SecuritiesRepository implements SecuritiesRepositoryInterface
{
    public function getAttributeValueForSecurity(string $securitySymbol, string $attributeName)
    {
        $security = Security::where('symbol', $securitySymbol)->first();
        if (!$security) {
            return null;
        }

        $attribute = $security->attributes->where('name', $attributeName)->first();
        if (!$attribute) {
            return null;
        }

        return $attribute->pivot->value;
    }
}
