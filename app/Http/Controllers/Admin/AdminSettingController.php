<?php

namespace App\Http\Controllers\Admin;

use App\Components\MenuRecusive;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogoAddRequest;
use App\Http\Requests\MenuAddRequest;
use App\Http\Requests\MenuEditRequest;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Logo;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function redirect;
use function view;

class AdminSettingController extends Controller

{
    use DeleteModelTrait;
    use StorageImageTrait;
    private $logo;

    public function __construct(Setting $logo)
    {
        $this->logo = $logo;
    }

    public function index(){
        $logo = $this->logo->first();
        return view('administrator.setting.add' , compact('logo'));
    }

    public function update(Request $request){


        $logo = $this->logo->first();

        $logo->update([
            'url_support' => $request->url_support
        ]);

        return back();
    }

}
