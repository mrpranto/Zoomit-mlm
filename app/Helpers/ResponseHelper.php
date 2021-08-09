<?php

use Illuminate\Http\RedirectResponse;

if (!function_exists('created_response')) {

    function created_response($key, $route = null, $type = 'success'): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $key.' created Successful');
        }

        return redirect()->back()->with($type, $key.' created Successful');
    }

}

if (!function_exists('updated_response')){

    function updated_response($key, $route = null, $type = 'success'): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $key.' update Successful');
        }

        return redirect()->back()->with($type, $key.' update Successful');
    }

}

if (!function_exists('deleted_response')){

    function deleted_response($key, $route = null, $type = 'success', $code = null): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $code ? foreign_key_exception($code) : $key.' delete Successful');
        }

        return redirect()->back()->with($type, $code ? foreign_key_exception($code) : $key.' delete Successful');
    }

}

if (!function_exists('active_response')){

    function active_response($key, $route = null, $type = 'success'): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $key.' active Successful');
        }

        return redirect()->back()->with($type, $key.' active Successful');
    }

}

if (!function_exists('inactive_response')){

    function inactive_response($key, $route = null, $type = 'success'): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $key.' inactive Successful');
        }

        return redirect()->back()->with($type, $key.' inactive Successful');
    }


}

if (!function_exists('upload_response')){

    function upload_response($key, $route = null, $type = 'success', $message= null): RedirectResponse
    {
        if ($route)
        {
            return redirect()->route($route)->with($type, $message ? $message : $key.' upload Successful');
        }

        return redirect()->back()->with($type, $message ? $message : $key.' upload Successful');
    }


}
