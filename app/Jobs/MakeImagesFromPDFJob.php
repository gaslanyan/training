<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;

class MakeImagesFromPDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pdf;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->pdf = $book;
    }

    /**
     * @throws \Spatie\PdfToImage\Exceptions\PageDoesNotExist
     * @throws \Spatie\PdfToImage\Exceptions\PdfDoesNotExist
     */
    public function handle()
    {
        $path = sprintf('%s%s/books/%d/', public_path(), Config::get('constants.UPLOADS'), $this->pdf->id);
        $pathToImage =  sprintf('%s%s',$path, $this->pdf->path);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0775, true, true);
        }

        if (file_exists($pathToImage)) {
            try{
                Ghostscript::setGsPath();
                $pdf = new Pdf($pathToImage);

                $pdf->saveAllPagesAsImages($path);
            }catch (\Exception $e){
                logger()->error($e);
            }
        }
    }
}
