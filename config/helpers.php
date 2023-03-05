<?php

    /**
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function includeResources() : array
    {
        return ( request() -> get( 'include' ) ) ? explode( ',', request() -> get( 'include' ) ) : [];
    }

    /**
     * Generate unique ID
     * @param $length
     * @return string
     */
    function generateAlphaNumericResource( $length ) : string
    {
        $token = "";

        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";

        $max = strlen( $codeAlphabet );

        for ( $i=0; $i < $length; $i++ )
        {
            $token .= $codeAlphabet[crypto_rand_secure( 0, $max-1 )];
        }

        return $token;
    }

    /**
     * @param $min
     * @param $max
     * @return int|mixed
     */
    function crypto_rand_secure( $min, $max ) : mixed
    {
        $range = $max - $min;

        if ( $range < 1 ) return $min;

        $log = ceil( log( $range, 2 ));
        $bytes = ( int ) ( $log / 8 ) + 1;
        $bits = ( int ) $log + 1;
        $filter = ( int ) ( 1 << $bits ) - 1;

        do
        {
            $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes )));
            $rnd = $rnd & $filter;
        }
        while ( $rnd > $range );

        return $min + $rnd;
    }
