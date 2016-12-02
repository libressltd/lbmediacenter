<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Auth;

class Media extends Model
{
	use Uuid32ModelTrait;

    static function saveFile($file, $is_base64)
    {
    	$media = new Media;
    	$media->mime_type = $file->getMimeType();
    	$media->original_extension = $file->getClientOriginalExtension();
    	$media->size = $file->getSize();
    	$media->save();

        if ($is_base64)
        {
            $data = base64_decode($file->getContents());
            Storage::putFileAs('media', $data, $media->id);
        }
        else
        {
            Storage::putFileAs('media', $file, $media->id);
        }
        return $media;
    }

    static function file($id)
    {
    	$media = Media::findOrFail($id);
        return response()->file(storage_path('app/media/'.$media->id));
    }

    static public function boot()
    {
        Media::bootUuid32ModelTrait();
        Media::saving(function ($media) {
            if (Auth::user())
            {
                if ($media->id)
                {
                    $media->updated_by = Auth::user()->id;
                }
                else
                {
                    $media->created_by = Auth::user()->id;
                }
            }
        });
    }
}
