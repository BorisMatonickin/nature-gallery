<?php

class CommentService {
    
    /**
     * ObjectFactory reference.
     */
    private $factory;
    
    /**
     * CommentMapper object reference
     */
    private $commentMapper;
    
    /**
     * Validator object reference.
     */
    private $validator;
    
    /**
     * Set the object parameters.
     * @param ObjectFactory $factory
     * @param CommentMapper $commentMapper
     * @param ValidationService $validator
     */
    public function __construct(ObjectFactory $factory, CommentMapper $commentMapper, ValidationService $validator) {
        $this->factory = $factory;
        $this->commentMapper = $commentMapper;
        $this->validator = $validator;
    }
    
    /**
     * 
     */
    public function comment($souceParams = []) {
        $this->validator->addSource($souceParams);
        $rules = $this->commentRules();
        $this->validator->addRules($rules);
        
        if ($this->validator->validate()) {
            $validated = $this->validator->getValidated();
            $comment = $this->factory->create('Comment');
            $comment->setUserId($validated['userId'])
                    ->setImageId($validated['imageId'])
                    ->setComment($validated['comment']);
            return $this->commentMapper->insertComment($comment);
        } else {
            return false;
        }
    }
    
    /**
     * Comment validation rules array.
     * @return array
     */
    private function commentRules() {
        return [
            'userId' => ['integer'],
            'imageId' => ['integer'],
            'comment' => ['required', 'minLength:1', 'regexp:/^[a-zA-Z0-9?$@#()\'"!,+\-=_;.&%\s]+$/']
        ];
    }
    
    /**
     * Get comments details based on passed image id.
     * @param type $imageId
     * @throws Exception - $imageId should be an valid integer
     */
    public function getCommentsByImageId($imageId) {
        if (!filter_var($imageId, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid parameter for image id');
        }
        return $this->commentMapper->fetchCommentsByImageId($imageId);
    }
    
    /**
     * Get errors from the validation process.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
}
