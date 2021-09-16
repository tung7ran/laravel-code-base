<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Options\Option;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getDeveloperConfig()
    {
        $content = Option::where('type', 'dev-config')->first();
        $content = json_decode(@$content->content);
        return view('backend.options.developer-config', compact('content'));
    }

    public function postDeveloperConfig(Request $request)
    {
        $options = Option::where('type', 'dev-config')->first();
        $options->content = !empty($request->content) ? json_encode($request->content) : null;
        $options->save();
        flash('Cập nhật thành công.')->success();
        return back();
    }

    public function getGeneralConfig()
    {
        $content = Option::where('type', 'general')->first();
        $content = json_decode(@$content->content);
        return view('backend.options.general', compact('content'));
    }

    public function postGeneralConfig(Request $request)
    {
        $options = Option::where('type', 'general')->first();
        $options->content = !empty($request->content) ? json_encode($request->content) : null;
        $options->save();
        flash('Cập nhật thành công.')->success();
        return back();
    }
}
