<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\News;
use App\Models\Product;
use App\Models\RestfulAPI;
use App\Models\Role;
use App\Models\Slider;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use function redirect;
use function view;

class ProductController extends Controller
{

    use DeleteModelTrait;
    use StorageImageTrait;

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function list(Request $request){
        return RestfulAPI::response(Product::class, $request);
    }
}
