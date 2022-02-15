<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Symfony\Component\Finder\SplFileInfo;

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
        $folder = Config::get('constants.UPLOADS') . "/books/" . $this->pdf->id;
        $path = sprintf('%s%s/', storage_path('app'), $folder);
        $pathToImage = $path . $this->pdf->path;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0775, true, true);
        }

        if (file_exists($pathToImage)) {
            $pdf = new Pdf($pathToImage);
            $np = $pdf->getNumberOfPages();

            foreach(range(1, $pdf->getNumberOfPages()) as $pageNumber) {
                $pdf->setPage($pageNumber)->saveImage($path . $pageNumber . '.jpg');
            }

            $files = File::files($path);

            foreach ($files as $f) {
                /** @var $f SplFileInfo */
                Storage::disk('s3')->put(sprintf('%s/%s', trim($folder, "/"), $f->getBasename()), File::get($f->getPathname()));
            }

           logger( Book::find($this->pdf->id)->update(['count'=>$np]));
            Storage::disk()->deleteDirectory(trim($folder, "/"));
        }
    }
}
