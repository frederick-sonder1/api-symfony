<?php

namespace App\Providers;

use DateTime;
use DateTimeImmutable;
use Faker\Provider\Base as BaseProvider;

final class DateTimeImmutableProvider extends BaseProvider
{
    public function dateImmutable(DateTime $dateTime)
    {
        return DateTimeImmutable::createFromMutable($dateTime);
    }
}