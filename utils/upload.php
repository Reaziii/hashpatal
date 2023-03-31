<?php
function upload($file)
{
    $filename = $file["name"];
    $milliseconds = floor(microtime(true) * 1000);
    $tempname = $file["tmp_name"];
    $folder = ROOT . "/uploads/" . $milliseconds . "~" . $filename;
    if (move_uploaded_file($tempname, $folder)) {
        $filename = "/uploads/" . $milliseconds . "~" . $filename;
        try {
            return $filename;
        } catch (Exception $err) {
            return "error";
        }
    } else {
        return "error";
    }
}

function restructure_files_array($files)
{
    $file_array = array();
    $file_count = count($files['name']);
    $file_keys = array_keys($files);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_array[$i][$key] = $files[$key][$i];
        }
    }

    return $file_array;
}
