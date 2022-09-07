<?php

namespace App\Http\Controllers;

use App\Good;
use App\Http\Resources\GoodCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Goods extends BaseController {

    //put your code here
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function catalog() {
        return new GoodCollection(Good::paginate(10));
    }

}
