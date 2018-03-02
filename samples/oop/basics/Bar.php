<?php

class Bar
{
    public function makeDarkBeer(Water $water, Solod $solod, Hmel $hmel)
    {
        return "Beer with {$water->get(50)} and {$solod->fry()->get(5)} and {$hmel->get(1)}";
    }
}
