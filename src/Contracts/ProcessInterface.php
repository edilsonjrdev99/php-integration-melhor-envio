<?php

namespace App\Contracts;

use App\Contracts\DTOInterface;

interface ProcessInterface {
  public function run(): DTOInterface;
}
