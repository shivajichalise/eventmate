<?php

namespace Database\Factories;

class CustomCountryProvider
{
    protected static $countries = [
        'Nepal',
        'India',
        'United States of America',
        'Germany',
        'Canada',
        'United Kingdom',
        'New Zealand',
        'South Korea',
        'Sweden',
        'Australia',
        'Japan',
        'France',
        'Netherlands',
        'Denmark',
        'Austria',
        'Italy',
        'Luxembourg',
        'Singapore',
        'Spain',
        'China',
        'Ireland',
        'Brazil',
        'Thailand',
        'Portugal',
        'Russia',
        'Israel',
    ];

    public static function randomCountry()
    {
        return static::$countries[array_rand(static::$countries)];
    }
}
