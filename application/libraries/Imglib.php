<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Imglib {

    public function image_resize($width=0,$height=0,$image_url,$filename,$upload_url){          

      $source_path = BASE_URL().$image_url;
      list($source_width, $source_height, $source_type) = getimagesize($source_path);
      switch ($source_type) {
        case IMAGETYPE_GIF:
        $source_gdim = imagecreatefromgif($source_path);
        break;
        case IMAGETYPE_JPEG:
        $source_gdim = imagecreatefromjpeg($source_path);
        break;
        case IMAGETYPE_PNG:
        $source_gdim = imagecreatefrompng($source_path);
        break;
      }

      $source_aspect_ratio = $source_width / $source_height;
      $desired_aspect_ratio = $width / $height;

      if ($source_aspect_ratio > $desired_aspect_ratio) {
        /*
        * Triggered when source image is wider
        */
        $temp_height = $height;
        $temp_width = ( int ) ($height * $source_aspect_ratio);
      } else {
        /*
        * Triggered otherwise (i.e. source image is similar or taller)
        */
        $temp_width = $width;
        $temp_height = ( int ) ($width / $source_aspect_ratio);
      }

    /*
    * Resize the image into a temporary GD image
    */

    $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
    imagecopyresampled(
      $temp_gdim,
      $source_gdim,
      0, 0,
      0, 0,
      $temp_width, $temp_height,
      $source_width, $source_height
    );

    /*
    * Copy cropped region from temporary image into the desired GD image
    */

    $x0 = ($temp_width - $width) / 2;
    $y0 = ($temp_height - $height) / 2;
    $desired_gdim = imagecreatetruecolor($width, $height);
    imagecopy(
      $desired_gdim,
      $temp_gdim,
      0, 0,
      $x0, $y0,
      $width, $height
    );

    /*
    * Render the image
    * Alternatively, you can save the image in file-system or database
    */

    $image_url =  $upload_url.$filename;    

    imagepng($desired_gdim,$image_url);

    return $image_url;

    /*
    * Add clean-up code here
    */
    }

}

?>