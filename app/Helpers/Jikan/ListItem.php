<?php

namespace App\Helpers\Jikan;

use App\Helpers\Jikan\Traitable\MakePublic;

class ListItem
{
    use MakePublic;

    public function __invoke($item)
    {
        $item = $this->makePublic($item);

        return $item;
    }
}
