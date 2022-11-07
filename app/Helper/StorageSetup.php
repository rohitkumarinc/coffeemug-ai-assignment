<?php

namespace App\Helper;
use Illuminate\Support\Facades\Storage;

trait StorageSetup
{
    private $default_icon = 'placeholder.jpg';

    /**
     * file_path
     *
     * @param  mixed $name
     * @param  mixed $type
     * @param  mixed $default
     * @return void
     */
    function file_path($name, $type='url', $default=true)
    {
        $value = $this->{$name};
        if($value){
            if(Storage::exists($value)){
                if ($type == 'url') {
                    return Storage::url($value);
                }
                return Storage::path($value);
            }else{
                // $this->{$name} = null;
                // $this->save();
            }
        }
        if ($default) {
            return url($this->default_icon);
        }
        return null;
    }

    /**
     * file_delete
     *
     * @param  mixed $name
     * @return void
     */
    function file_delete($name)
    {
        $value = $this->{$name};
        if($value){
            if(Storage::exists($value)){
                return Storage::delete($value);
            }
        }
        return false;
    }

}
