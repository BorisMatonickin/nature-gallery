<?php

class UploadFileService {
    
    /**
     * The name of the file.
     */
    private $fileName;
    
    /**
     * Destination of final upload.
     */
    private $uploadDir;
    
    /**
     * Maximum allowed file size. 
     */
    private $maxFileSize;
    
    /**
     * Allowed MIME file types.
     */
    private $allowedFileTypes = [];
    
    /**
     * File extension.
     */
    private $extension;
    
    /**
     * File type.
     */
    private $fileType;
    
    /**
     * File size.
     */
    private $fileSize;
    
    /**
     * The image details array.
     */
    private $imageDetails = [];
    
    /**
     * Upload errors
     */
    private $error;
    private $uploadErrors = [
        UPLOAD_ERR_OK => 'No errors',
        UPLOAD_ERR_INI_SIZE => 'Larger than upload_max_file_size',
        UPLOAD_ERR_FORM_SIZE => 'Larger than form MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'Partial upload',
        UPLOAD_ERR_NO_FILE => 'No file',
        UPLOAD_ERR_NO_TMP_DIR => 'No temporary directory',
        UPLOAD_ERR_CANT_WRITE => 'Cant write to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    
    /**
     * Check and validate uploaded file. If all condition are satisfied move uploaded file to choosen upload directory.
     * @param array $file
     * @return boolean
     */
    public function attachFile($file = []) {
        // set the error if file doesn't exists, is empty or is not array
        if (!$file || empty($file) || !is_array($file)) {
            $this->error = 'No file was uploaded';
            return false;
        // set the error if error index in file array is not set or if it's subarray    
        } else if (!isset($file['error']) || is_array($file['error'])) {
            $this->error = 'Invalid parameters';
            return false;
        // set the appropriate error if error index in file array is other than 0    
        } else if ($file['error'] != 0) {
            $this->error = $this->uploadErrors[$file['error']];
            return false;
        // set the error if type of the file is not as it is set it should be    
        } else if ($this->validateMimeType($file['tmp_name']) === false) {
            $this->error = 'Invalid file format';
            return false;
        // set the error if file size is larger than one that's set    
        } else if ($this->validateFileSize($file['size']) === false) {
            $this->error = 'Invalid file size';
            return false;
        } else {
            $this->fileName = $this->nameFile($file['tmp_name']);
            $this->imageDetails = getimagesize($file['tmp_name']);
            if (!move_uploaded_file($file['tmp_name'], $this->uploadDir . $this->fileName)) {
                $this->error = 'The file upload failed';
                return false;
            } else {
                $this->fileType = $file['type'];
                $this->fileSize = $file['size'];
                return true;
            }
        }
    }
    
    /**
     * Validate the file MIME type.
     * @param string $file
     * @return boolean
     */
    private function validateMimeType($file) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $this->extension = array_search($finfo->file($file), $this->allowedFileTypes, true);
        return ($this->extension === false) ? false : true;
    }
    
    /**
     * Validate the file size.
     * @param int $fileSize
     * @return boolean
     */
    private function validateFileSize($fileSize) {
        if (!filter_var($fileSize, FILTER_VALIDATE_INT)) {
            return false;
        } else {
            return ($fileSize > $this->maxFileSize) ? false : true;
        }
    }
    
    /**
     * Set the final name of the uploaded file.
     * @param string $file
     * vreturn string
     */
    public function nameFile($file) {
        return sprintf('%s.%s', sha1_file($file), $this->extension);
    }
    
    /**
     * Destroy file.
     * @param string $file
     * @param string $dir
     * @return boolean
     */
    public function destroyFile($file, $dir = '') {
        $targetPath = (!empty($dir)) ? $dir . $file : $this->uploadDir . $file;
        if (file_exists($targetPath)) {
            return unlink($targetPath) ? true : false;
        }
        return false;
    }
    
    /**
     * Set the maximum file size.
     * @param string $maxFileSize
     */
    public function setMaxFileSize($maxFileSize) {
        $this->maxFileSize = $maxFileSize;
    }
    
    /**
     * Set the allowed MIME types.
     * @param array $allowedFileTypes
     */
    public function setAllowedFileTypes($allowedFileTypes = []) {
        $this->allowedFileTypes = $allowedFileTypes;
    }
    
    /**
     * Set the upload directory.
     * @param string $uploadDir
     */
    public function setUploadDir($uploadDir) {
        $this->uploadDir = $uploadDir;
    }
    
    /**
     * Get the error.
     * @return string
     */
    public function getError() {
        return $this->error;
    }
    
    /**
     * Get the uploaded file name.
     * @return string
     */
    public function getFileName() {
        return $this->fileName;
    }
    
    /**
     * Get the uploaded file type.
     * @return string
     */
    public function getFileType() {
        return $this->fileType;
    }
    
    /**
     * Get the uploaded file size.
     * @return int
     */
    public function getFileSize() {
        return $this->fileSize;
    }
    
    /**
     * Get the image width.
     * @return int or null
     */
    public function getImageWidth() {
        if (isset($this->imageDetails[0])) {
            return $this->imageDetails[0];
        }
        return null;
    }
    
    /**
     * Get the image height.
     * @return int or null
     */
    public function getImageHeight() {
        if (isset($this->imageDetails[1])) {
            return $this->imageDetails[1];
        }
        return null;
    }
}

