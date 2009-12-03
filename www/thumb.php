<?php
$file = isset($_GET['file']) ? $_GET['file'] : false;


if($file){


    // orginal size
    $orig_w = $this->info_frameWidth;
    $orig_h = $this->info_frameHeight;
    $orig_rapport = $orig_w / $orig_h;

    // taille de la frame resample (sans bandes noires)
    $resampled_frame_h = $w / $orig_rapport;
    $new_img_y_offset = ($h - $resampled_frame_h) / 2;

    // une frame un peu au hasard...
    $rand_frame_idx = rand(min(100, $this->info_frameCount-1), min(1000, $this->info_frameCount-1));
    $frame = $this->_info()->getFrame($rand_frame_idx);

    //$frame = $this->info_nextKeyFrame;

    $img = $frame->toGDImage();

    // une image pile poil à la taille de l'extrait
    $resampled_frame = imagecreatetruecolor($w, $resampled_frame_h);
    imagecopyresampled($resampled_frame, $img, 0, 0, 0, 0, $w, $resampled_frame_h, $orig_w, $orig_h);
    imagedestroy($img);

    // on met l'image croppé et resizé dans le thumb final
    $new_img = imagecreatetruecolor($w, $h);
    imagecopy($new_img, $resampled_frame, 0, $new_img_y_offset, 0, 0, $w, $resampled_frame_h);
    imagedestroy($resampled_frame);
    return $new_img;
}