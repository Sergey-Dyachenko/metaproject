<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 23:58
 */


namespace App\Http\Controllers\Api;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index()
    {
        $files = File::all();
        return response()->json($files);
    }
}
