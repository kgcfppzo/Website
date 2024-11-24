<?php function createFilePath($folder, $file, $allowedTypes){
        global $storagePath, $appUrl;
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . $storagePath . $folder;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($file['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    return $appUrl . $storagePath . $folder . '/' . $fileName;
                }
            }
}

?>