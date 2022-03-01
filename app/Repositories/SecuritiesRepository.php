<?php

namespace App\Repositories;

use App\Models\Security;
use App\Repositories\SecuritiesRepositoryInterface;

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
