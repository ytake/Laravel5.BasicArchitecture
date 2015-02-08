<?php

/**
 * このコントローラーはcomposer.jsonでclassmapを利用しています。
 * このため、Laravel4のデフォルトと同様にnamespaceを使わずに実装することが可能です。
 * Eloquentなどのモデルも同様にclassmapを利用することでnamespaceを利用しないで実装することが可能です。
 *
 * Class LegacyController
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class LegacyController extends \App\Http\Controllers\Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function getForm()
    {
        return view('legacy.old.form');
    }

    /**
     * フォームリクエストと、これまでのViewファサードを利用した例
     *
     * @param \App\Http\Requests\LegacyFormRequest $request
     * @return \Illuminate\View\View
     */
    public function postConfirm(\App\Http\Requests\LegacyFormRequest $request)
    {
        // global function
        return View::make('legacy.old.confirm');
    }

    /**
     * Requestクラスをメソッドインジェクションで利用せずに、
     * 従来のInputファサードを利用する例
     * @param \Illuminate\Http\Request $request
     * @return $this
     */
    public function postApply(\Illuminate\Http\Request $request)
    {
        if(!is_null($request->_return)) {
            return \Redirect::route('legacy.form')->withInput();
        }
        $request = Input::only('name', 'email');
        // 同様にnamespaceを利用せずにEloquentなどを利用することができます
        Session::forget('_token');
        return view('legacy.old.apply')->with('request', $request);
    }

}
