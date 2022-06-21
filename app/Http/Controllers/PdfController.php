<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Services\PdfService;
use App\Http\Requests\StorePdfRequest;
use App\Http\Requests\UpdatePdfRequest;
use App\Http\Controllers\BaseController;

class PdfController extends BaseController
{
    protected PdfService $service;

    public function __construct()
    {
        $this->service = new PdfService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponseAjax('Pdf Resources retrived Successfully', Pdf::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePdfRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePdfRequest $request)
    {
        $this->service->store($request->title, $request->file);
        return $this->sendResponseAjax('Pdf Resource created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePdfRequest  $request
     * @param  \App\Models\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePdfRequest $request, Pdf $pdf)
    {
        $this->service->update($pdf, $request->title, $request->file);
        return $this->sendResponseAjax('Pdf Resource updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pdf $pdf)
    {
        $this->service->destroy($pdf);
        return $this->sendResponseAjax('Pdf Resource deleted Successfully');
    }
}
