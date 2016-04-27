<?php

class ImageService {
    
    /**
     * ImageMapper object reference.
     */
    private $imageMapper;
    
    /**
     * CategoryMapper object reference.
     */
    private $categoryMapper;
    
    /**
     * ValidationService object reference. 
     */
    private $validator;
    
    /**
     * ObjectFactory object reference.
     */
    private $factory;
    
    /**
     * UploadFileService object reference;
     */
    private $uploadService;
    
    /**
     * Set the object parameters.
     * @param ImageMapper $imageMapper
     * @param CategoryMapper $catMapper
     * @param ValidationService $validator
     * @param ObjectFactory $factory
     * @param UploadFileService $uploadService
     */
    public function __construct(ImageMapper $imageMapper, CategoryMapper $catMapper, ValidationService $validator, ObjectFactory $factory, 
                                UploadFileService $uploadService) {
        $this->imageMapper = $imageMapper;
        $this->categoryMapper = $catMapper;
        $this->validator = $validator;
        $this->factory = $factory;
        $this->uploadService = $uploadService;
    }
    
    /**
     * Get few images of categories for the main index page.
     * @return array
     */
    public function getCategoriesWithImagesForIndex() {
        return $this->imageMapper->fetchCategoriesWithImagesForIndex();
    }
    
    /**
     * Get the image details based on passed image id
     * @param int $imageId
     * @throws Exception - $imageId should be an valid integer
     */
    public function getImageDetails($imageId) {
        if (!filter_var($imageId, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid parameter for image id');
        }
        $sanitized = filter_var($imageId, FILTER_SANITIZE_NUMBER_INT);
        return $this->imageMapper->fetchImageDetails($sanitized);
    }
    
    /**
     * Get all images from the user.
     * @param int $userId
     * @throws Exception - $userId should be an valid integer
     */
    public function getUserImages($userId) {
        if (!filter_var($userId, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid parameter for user id');
        }
        $sanitized = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        return $this->imageMapper->fetchUserImages($sanitized);
    }
    
    /**
     * Get all categories name.
     */
    public function getCategoriesName() {
        return $this->categoryMapper->fetchCategoriesName();
    }
    
    /**
     * Set the image object parameters if validations are successfull.
     * @param int $userId
     * @param array $file - the array of the file data from the form
     * @param array $sourceParams - the array of source values to be validated
     * @return boolean
     */
    public function uploadImage($userId, $file = [], $sourceParams = []) {
        $rules = $this->uploadRules();
        $val = $this->validateData($sourceParams, $rules);
        $fileVal = $this->validateUploadedFile($file);
        if ($val && $fileVal) {
            $validated = $this->validator->getValidated();
            $fileName = $this->uploadService->getFileName();
            $fileType = $this->uploadService->getFileType();
            $fileSize = $this->uploadService->getFileSize();
            $width = $this->uploadService->getImageWidth();
            $height = $this->uploadService->getImageHeight();
            $image = $this->factory->create('Image');
	$sanitizedUserId = $this->validateAndSanitizeId($userId);
            
            $image->setUserId($sanitizedUserId)
                  ->setName($fileName)
                  ->setType($fileType)
                  ->setSize($fileSize)
                  ->setWidth($width)
                  ->setHeight($height)
                  ->setCaption($validated['caption'])
                  ->setDescription($validated['description'])
                  ->setImageCategory($validated['category']);
            return $this->imageMapper->insertImage($image);
        }
        return false;
    }
    
    /**
     * Set image object parameters on update image details. All fields are optional to edit.
     * @param int $imageId
     * @param array $sourceParams
     * @return boolean
     */
    public function editImage($imageId, $sourceParams = []) {
        $rules = $this->editImageRules();
        $val = $this->validateData($sourceParams, $rules);
        if ($val) {
            $validated = $this->validator->getValidated();
	$sanitizedImageId = $this->validateAndSanitizeId($imageId);
            $image = $this->factory->create('Image');
            $image->setId($sanitizedImageId)
                  ->setImageCategory($validated['category']);
            if (isset($validated['caption'])) {
                $image->setCaption($validated['caption']);
            }
            if (isset($validated['description'])) {
                $image->setDescription($validated['description']);
            }
            return $this->imageMapper->updateImageDetails($image);
        }
        return false;
    }
    
    /**
     * Process of image deletion.
     * @param int $imageId
     * @param string $imageName
     */
    public function deleteImage($imageId, $imageName) {
        $sanitizedImageId = $this->validateAndSanitizeId($imageId);
        $image = $this->factory->create('Image');
        $image->setId($sanitizedImageId);
        $delete = $this->imageMapper->deleteImage($image);
        if ($delete) {
	$dir = ROOT . DS . 'webroot' . DS . 'img' . DS;
	$this->uploadService->destroyFile($imageName, $dir);
	return true;
        }
        return false;
    }
    
    /**
     * 
     */
    private function validateAndSanitizeId($id) {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
	throw new InvalidArgumentException('Invalid parameter for id');
        }
        $sanitized = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $sanitized;
    }
    
    /**
     * Validate form data of the upload image form.
     * @param array $sourceParams - the array of source values to be validated
     * @param array $rules - the rules for the validation process
     * @return boolean
     */
    private function validateData($sourceParams = [], $rules = []) {
        $this->validator->addSource($sourceParams);
        $this->validator->addRules($rules);
        return ($this->validator->validate()) ? true : false;
    }
    
    /**
     * Validate and upload image file.
     * @param array $file - the array of the file data from the form
     */
    private function validateUploadedFile($file = []) {
        $this->uploadService->setMaxFileSize(2097152);
        $allowedFileTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $this->uploadService->setAllowedFileTypes($allowedFileTypes);
        $uploadDir = ROOT . DS . 'webroot' . DS . 'img' . DS;
        $this->uploadService->setUploadDir($uploadDir);
        $val = $this->uploadService->attachFile($file);
        return ($val === true) ? true : false;
    }
    
    /**
     * @return array - validation rules for the image uploading process
     */
    private function uploadRules() {
        return [
            'caption' => ['alphaNum', 'minLength:2', 'maxLength:200', 'regexp:/^[A-Za-z0-9\-\s]{2,200}$/i'],
            'description' => ['regexp:/^[a-zA-Z0-9?$@#()\'"!,+\-=_;.&%\s]+$/'],
            'category' => ['integer', 'required'],
            'captcha' => ['alphaNum', 'required', 'sessionMatch:captcha'],
        ];
    }
    
    /**
     * @return array - validation rules for editing the image
     */
    private function editImageRules() {
        return [
            'caption' => ['alphaNum', 'minLength:2', 'maxLength:200', 'regexp:/^[A-Za-z0-9\-\s]{2,200}$/i'],
            'description' => ['regexp:/^[a-zA-Z0-9?$@#()\'"!,+\-=_;.&%\s]+$/'],
            'category' => ['integer', 'required'],
        ];
    }
    
    /**
     * Get the file validation and upload error if it occurs.
     * @return string
     */
    public function getFileError() {
        return $this->uploadService->getError();
    }
    
    /**
     * Get the validation process errors array.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
}
