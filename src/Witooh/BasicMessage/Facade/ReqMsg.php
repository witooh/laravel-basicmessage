<?php

namespace Witooh\BasicMessage\Facade;

use Illuminate\Support\Facades\Facade;

class ReqMsg extends Facade {
    protected static function getFacadeAccessor() { return 'reqmsg'; }
}
