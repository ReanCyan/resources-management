<?php

namespace App\Services;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    const SAVE_PATH = 'uploads/pdf';

    /**
     * Get fillable attributes for model
     *
     * @param  string            $title
     * @param  UploadedFile|null $file
     * @return array
     */
    public function getFillables(string $title, UploadedFile|null $file = null): array
    {
        $data = [ 'title' => $title ];

        if($file) {
            $data = array_merge($data, $this->fileTransform($file));
        }

        return $data;
    }

    /**
     * Generate fillable attributes from uploaded file
     *
     * @param  UploadedFile $file
     * @return array
     */
    public function fileTransform(UploadedFile $file): array
    {
        return [
            'unique_name'   => uniqid(),
            'original_name' => $file->getClientOriginalName(),
            'extension'     => $file->getClientOriginalExtension(),
            'location'      => self::SAVE_PATH,
            'size'          => $file->getSize()
        ];
    }

    /**
     * Store pdf resource
     *
     * @param  string       $title
     * @param  UploadedFile $file
     * @return Pdf
     */
    public function store(string $title, UploadedFile $file): Pdf
    {
        $pdf = Pdf::create($this->getFillables($title, $file));

        $file->storeAs($pdf->location, $pdf->unique_name. '.' .$pdf->extension);

        return $pdf;
    }

    /**
     * Update pdf resource and remove old uploaded file
     *
     * @param  Pdf               $pdf
     * @param  string            $title
     * @param  UploadedFile|null $file
     * @return Pdf
     */
    public function update(Pdf $pdf, string $title, UploadedFile|null $file = null): Pdf
    {
        $oldPdfLocation = $pdf->path;

        $pdf->update($this->getFillables($title, $file));
        $pdf = $pdf->refresh();

        if($file) {
            $file->storeAs($pdf->location, $pdf->unique_name. '.' .$pdf->extension);
            $this->removeFile($oldPdfLocation);
        }

        return $pdf;
    }

    /**
     * Remove pdf resource and uploaded file
     *
     * @param  Pdf    $pdf
     * @return void
     */
    public function destroy(Pdf $pdf): void
    {
        $pdf->delete();
        $this->removeFile($pdf->path);
    }

    /**
     * Remove file from storage
     *
     * @param  String    $path
     * @return void
     */
    public function removeFile(String $path): void
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }


    /**
     * Download file from storage.
     *
     * @param  Pdf    $pdf
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile(Pdf $pdf)
    {
        return Storage::download($pdf->path, $pdf->original_name, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
