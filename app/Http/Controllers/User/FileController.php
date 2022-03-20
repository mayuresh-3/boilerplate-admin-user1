<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    private $driver = 'local'; // real : s3, localhost : local

    function __construct() {
        $this->driver =config('filesystems.driver');
    }

    // Uploaod file to AWS s3
    //show files in list
    //get file path
    /**
     * @api {post} /api/file/uploads
     * @apiGroup S3 : Upload Single File to S3
     * @apiName store
     * @apiParam {File} file_name File object to be uploaded.
     * @apiDescription This is to allow user upload a single file.
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept": "application/json",
     *       "Content-Type": "application/json",
     *       "Authorization":"Bearer <TOKEN>"
     *     }
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *       {
     *            "path": "<File URL>",
     *            "message" : "success"
     *
     *        }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 401 Not Found
     *       {
     *           "error": "Unauthenticated."
     *       }
     */
    public function store(Request $request)
    {

        $fileSystem = $this->driver;

        try {

//            $file = $request->file_name;
            //get unique Id
//            $uuid = Str::uuid()->toString() . Str::uuid()->toString();
//            //get each uuid
//
//            for ($i = 0; $i < 8;) {
//                $uuid = substr($uuid, 0, $i++) . '/' . substr($uuid, $i++);
//            }
//            if ($request->duration) {
//                //unique file name(with duration)
//                $file_name = $uuid . '&' . $request->duration . '&' . $file->getClientOriginalName();
//
//            } else {
//                //unique file name(without duration)
//                $file_name = $uuid . '&' . $file->getClientOriginalName();
//            }
            //store file on s3 bucket
            $file = $request->file_name;
            $file_name = $file->getClientOriginalName();
//            $request->file_name->move(public_path('uploads'), $file_name);
            Storage::disk($fileSystem)->put($file_name, @file_get_contents($file));

            if (!$request->has('visibility') || $request->visibility != "private") {
                //set visibility changes
                Storage::disk($fileSystem)->setVisibility($file_name, 'public');
            }
            //get file url
            $data['path'] = config('app.url') . Storage::disk($fileSystem)->url($file_name);

            $data['message'] = 'success';
            //return data
            return response()->json($data, 200);

        } catch (\Exception $error) {
            report($error);
            //exception occurs then return error reponse

            dd($error);
        }
    }
}
