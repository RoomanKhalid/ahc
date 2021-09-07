<?php

namespace App\Http\Controllers\webAdmin;

use App\Models\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HelperController extends Controller
{

  public function a($errors,$b){
    if($errors->first($b))
    echo '<div class="alert alert-danger">'
        .$errors->first($b).
    '</div>';
  }
  // lata nh praticle work karay ga
    public static function uplaodsingleImage($file,$path){
        $name = $file->getClientOriginalName();
        $slug = preg_replace('/\s+/', '-', $name);
        $slug = pathinfo($slug, PATHINFO_FILENAME);
        //$extension = pathinfo($slug, PATHINFO_EXTENSION);
        //$slug = str_replace(' ','-',$name);
        $extension = $file->getClientOriginalExtension();
        $filename = $path.$slug.'-'.time() .'.' .$extension;
        $fileUrl = URL($filename);
        $file->move($path, $filename);
        return $fileUrl;

          // $file = $req->file('pic');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time() .'.' .$extension;
            // $file->move('images/categories/', $filename);
            // $category->pic = $filename;
    }


}