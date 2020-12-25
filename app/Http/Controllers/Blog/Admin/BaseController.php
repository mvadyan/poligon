<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestController;
use Illuminate\Http\Request;

/**
 * Class BaseController
 * @package App\Http\Controllers\Blog\Admin
 */
abstract class BaseController extends GuestController
{

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
    }
    //
}
