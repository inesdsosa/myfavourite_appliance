<?php

namespace myFavouriteAppliance\Source;

use myFavouriteAppliance\SourceUrl;

interface SourceInterface
{
    public function load(SourceUrl $url) : void;

    //public function hasProduct() : bool;

}
