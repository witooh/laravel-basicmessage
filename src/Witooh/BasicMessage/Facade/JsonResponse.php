<?php

namespace Witooh\BasicMessage\Facade;

use Illuminate\Support\Facades\Facade;

class JsonResponse extends Facade {
    protected static function getFacadeAccessor() { return 'jsonresponse'; }
}
