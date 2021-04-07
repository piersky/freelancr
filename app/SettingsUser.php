<?php
namespace App;

use Spatie\Valuestore\Valuestore;
use Auth;

class SettingsUser extends Valuestore
{
    private $prefix;

    public function __construct()
    {
        if (!empty(Auth::id())) $this->prefix = Auth::id().'_';
    }

    public function put($key, $value = null){
        $name = $this->prefix.$key;
        return parent::put($name, $value);
    }

    public function has(string $key) : bool
    {
        $name = $this->prefix.$key;
        return parent::has($name);
    }

    public function get($key, $default = null){
        $name = $this->prefix.$key;
        return parent::get($name, $default);
    }

    public function forget($key){
        $name = $this->prefix.$key;
        return parent::forget($name);
    }

    public function flush(){
        $sets = [
            //'filiale_id',
        ];

        foreach ($sets as $setting) $this->forget($setting);
    }
}
