<?php

namespace Witooh\BasicMessage\Facade;

use Illuminate\Support\Facades\Facade;

class ResMsg extends Facade {
    protected static function getFacadeAccessor() { return 'resmsg'; }
}
