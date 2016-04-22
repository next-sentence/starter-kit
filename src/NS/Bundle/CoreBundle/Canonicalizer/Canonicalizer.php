<?php

namespace NS\Bundle\CoreBundle\Canonicalizer;

/**
 * Class Canonicalizer
 */
class Canonicalizer
{
    public function canonicalize($string)
    {
        return null === $string ? null : mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string));
    }
}
