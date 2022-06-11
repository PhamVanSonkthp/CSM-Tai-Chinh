<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess(){
        $this->defineGateUser();
        $this->defineGateEmployee();
        $this->defineGateRole();
        $this->defineGatePermission();
        $this->defineGateNotification();
        $this->defineGateLogo();
        $this->defineGateHistoryData();
        $this->defineGateSlider();
        $this->defineGateLend();
    }

    public function defineGateLend(){
        Gate::define('lend-list','App\Policies\LendPolicy@view');
        Gate::define('lend-add','App\Policies\LendPolicy@create');
        Gate::define('lend-edit','App\Policies\LendPolicy@update');
        Gate::define('lend-delete','App\Policies\LendPolicy@delete');
    }

    public function defineGateSlider(){
        Gate::define('slider-list','App\Policies\SliderPolicy@view');
        Gate::define('slider-add','App\Policies\SliderPolicy@create');
        Gate::define('slider-edit','App\Policies\SliderPolicy@update');
        Gate::define('slider-delete','App\Policies\SliderPolicy@delete');
    }

    public function defineGateUser(){
        Gate::define('user-list','App\Policies\UserPolicy@view');
        Gate::define('user-add','App\Policies\UserPolicy@create');
        Gate::define('user-edit','App\Policies\UserPolicy@update');
        Gate::define('user-delete','App\Policies\UserPolicy@delete');
    }

    public function defineGateEmployee(){
        Gate::define('employee-list','App\Policies\EmployeePolicy@view');
        Gate::define('employee-add','App\Policies\EmployeePolicy@create');
        Gate::define('employee-edit','App\Policies\EmployeePolicy@update');
        Gate::define('employee-delete','App\Policies\EmployeePolicy@delete');
    }

    public function defineGateRole(){
        Gate::define('role-list','App\Policies\RolePolicy@view');
        Gate::define('role-add','App\Policies\RolePolicy@create');
        Gate::define('role-edit','App\Policies\RolePolicy@update');
        Gate::define('role-delete','App\Policies\RolePolicy@delete');
    }

    public function defineGatePermission(){
        Gate::define('permission-list','App\Policies\PermissionPolicy@view');
        Gate::define('permission-add','App\Policies\PermissionPolicy@create');
        Gate::define('permission-edit','App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete','App\Policies\PermissionPolicy@delete');
    }

    public function defineGateNotification(){
        Gate::define('notification-list','App\Policies\NotificationPolicy@view');
        Gate::define('notification-add','App\Policies\NotificationPolicy@create');
        Gate::define('notification-edit','App\Policies\NotificationPolicy@update');
        Gate::define('notification-delete','App\Policies\NotificationPolicy@delete');
    }

    public function defineGateLogo(){
        Gate::define('logo-list','App\Policies\LogoPolicy@view');
        Gate::define('logo-add','App\Policies\LogoPolicy@create');
        Gate::define('logo-edit','App\Policies\LogoPolicy@update');
        Gate::define('logo-delete','App\Policies\LogoPolicy@delete');
    }

    public function defineGateHistoryData(){
        Gate::define('history-data-list','App\Policies\HistoryDataPolicy@view');
        Gate::define('history-data-add','App\Policies\HistoryDataPolicy@create');
        Gate::define('history-data-edit','App\Policies\HistoryDataPolicy@update');
        Gate::define('history-data-delete','App\Policies\HistoryDataPolicy@delete');
    }

}
