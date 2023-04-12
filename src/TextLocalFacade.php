<?php

namespace Hmimeee\TextLocal;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hmimeee\TextLocal\Skeleton\SkeletonClass
 */
class TextLocalFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'textlocal';
    }
}
