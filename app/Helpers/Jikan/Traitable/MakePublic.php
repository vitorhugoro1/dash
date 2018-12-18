<?php

namespace App\Helpers\Jikan\Traitable;

use Illuminate\Support\Carbon;
use Jikan\Model\Common\DateRange;
use ReflectionClass;
use ReflectionProperty;

trait MakePublic
{
    protected function makePublic($object): array
    {
        $array = [];
        $reflection = new ReflectionClass($object);
        $props = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $value = $prop->getValue($object);

            if ($value instanceof \DateTimeImmutable) {
                $value = Carbon::createFromTimestamp($value->getTimestamp(), $value->getTimezone());
            }

            if ($value instanceof DateRange) {
                $from = $value->getFrom();
                $value = Carbon::createFromTimestamp($from->getTimestamp(), $from->getTimezone());
            }

            $array[$name] = $value;
        }
        return $array;
    }
}
