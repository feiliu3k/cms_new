<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use YuanChao\Editor\EndaEditor;
use Redirect, Input, Response, Image;


class NewsUploadController extends Controller
{

    public function uploadImgFile()
    {
        //Ajax上传图片
        $file = Input::file('file');
        $filetype = Input::get('filetype');
        $ext=strtolower($file->getClientOriginalExtension());

        $allowed_extensions = array("jpg", "bmp", "gif", "tif","png","jpeg","mp4","3gp","mkv","mpg","avi","mov","m4v");
        if ($ext && !in_array($ext, $allowed_extensions)) {
            return Response::json([ 'errors' => '只能上传png、jpg、gif、avi、mov、mp4等等文件.']);
        }
        if ($filetype=='image'){
            $destinationPath = config('cms.news_image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);
            $img = Image::make(public_path($destinationPath.$fileName))
                        ->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
            $img->save(public_path($destinationPath.$fileName));
        }else if($filetype=='video'){
            $destinationPath = config('cms.news_video_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);

        }else if($filetype=='itemimage'){
            $destinationPath = config('cms.news_image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);
            $img = Image::make(public_path($destinationPath.$fileName))
                        ->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
            $img->save(public_path($destinationPath.$fileName));
        }else if($filetype=='itemvideo'){
            $destinationPath = config('cms.news_video_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);
        }
        return Response::json(
            [
                'success' => true,
                'src' =>$fileName,
                'filetype' => $filetype
            ]
        );
    }
}
