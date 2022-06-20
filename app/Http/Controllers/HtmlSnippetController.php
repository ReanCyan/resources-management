<?php

namespace App\Http\Controllers;

use App\Models\HtmlSnippet;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreHtmlSnippetRequest;
use App\Http\Requests\UpdateHtmlSnippetRequest;

class HtmlSnippetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponseAjax('Html Snippet Resources retrived Successfully', HtmlSnippet::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHtmlSnippetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHtmlSnippetRequest $request)
    {
        HtmlSnippet::create($request->except('isEdit'));
        return $this->sendResponseAjax('Html Snippet Resource created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHtmlSnippetRequest  $request
     * @param  \App\Models\HtmlSnippet  $htmlSnippet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHtmlSnippetRequest $request, HtmlSnippet $htmlSnippet)
    {
        $htmlSnippet->fill($request->except('isEdit'))->save();
        return $this->sendResponseAjax('Html Snippet Resource updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HtmlSnippet  $htmlSnippet
     * @return \Illuminate\Http\Response
     */
    public function destroy(HtmlSnippet $htmlSnippet)
    {
        $htmlSnippet->delete();
        return $this->sendResponseAjax('Html Snippet Resource deleted Successfully');
    }
}
