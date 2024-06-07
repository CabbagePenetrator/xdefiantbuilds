<?php

namespace App\Enums;

enum AttachmentType: string
{
    case MUZZLE = 'muzzle';
    case BARREL = 'barrel';
    case FRONT_RAIL = 'front rail';
    case OPTICS = 'optics';
    case MAGAZINE = 'magazine';
    case REAR_GRIP = 'rear grip';
    case STOCK = 'stock';
}
