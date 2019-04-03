<?php

namespace App\Searches\Commands;

interface ISearchCommand
{
    public function search($query, $filters, $from, $size);
}