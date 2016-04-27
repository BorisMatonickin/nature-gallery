<?php

class Captcha {
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * 
     */
    private $captcha = 'captcha';
    
    /**
     * The font file for captcha image.
     */
    private $font;
    
    /**
     * Width and height of captcha image.
     */
    private $width = 70;
    private $height = 70;
    
    /**
     * Font size
     */
    private $fontSize = 40;
    
    /**
     * Width of each character.
     */
    private $characterWidth = 40;
    
    /**
     * Sets session object reference.
     */
    public function __construct(Session $session) {
        $this->session = $session;
    }
    
    /**
     * Set the font that will be used for captcha image.
     * @return font
     */
    private function setFont() {
        $this->font = $this->captcha;
        $pathToFontFile = ROOT . DS . 'lib' . DS . 'base'. DS . 'assets' . DS . 'AnonymousClippings.ttf';
        $anonymousClippings = file_get_contents($pathToFontFile);
        // if file doesn't exists create one and write content
        $handle = fopen($this->font, 'w+');
        fwrite($handle, $anonymousClippings);
        fclose($handle);
        
        return $this->font;
    }
    
    /**
     * Return random lower case letter, upper case letter or number between 0 and 9 
     *  based on ASCII codes.
     */
    private function getRandom() {
        $type = rand(0,2);
        switch($type) {
            case 2:
                $random = chr(rand(65,90));
                break;
            case 1:
                $random = chr(rand(97,122));
                break;
            default:
                $random = rand(1,9);
                break;
        }
        return $random;
    }
    
    /**
     * Generate captcha code for image and session storage
     * @param int $length - length of the captcha code
     * @return string $code
     */
    private function generateCode($length) {
        $code = null;      
        for ($i = 0; $i < $length; $i++) {
            $code .= strtolower($this->getRandom());
        }       
        $this->session->put($this->captcha, $code);
        
        $this->width = $length * $this->characterWidth;
        
        return $code;
    }
    
    /**
     * Get captcha image.
     */
    public function image() {
        $length = 6;
        $code = $this->generateCode($length);
        $this->setFont();
        // start buffering of the image
        ob_start();
        $image = imagecreatetruecolor($this->width, $this->height);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, $this->width, $this->height, $white);
        // randomize image with dots
        for ($dot = 0; $dot < 2000; $dot++) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            $dotColor = imagecolorallocate($image, $r, $g, $b);
            // coordinates for dotes
            $x1 = rand(0, $this->width);
            $y1 = rand(0, $this->height);
            // end coordinates for dotes;
            $x2 = $x1 + 1;
            $y2 = $y1 + 1;
            
            imageline($image, $x1, $y1, $x2, $y2, $dotColor);
        }
        // add all letters to the image
        for ($start = -$length; $start < 0; $start++) {
            $color = imagecolorallocate($image, rand(0,177), rand(0,177), rand(0,177));
            $character = substr($code, $start, 1);
            // coordinates of characters
            $x = ($start + 6) * $this->characterWidth;
            $y = rand($this->height - 20, $this->height - 10);
            
            imagettftext($image, $this->fontSize, 0, $x, $y, $color, $this->font, $character);
        }
        
        imagepng($image);
        imagedestroy($image);
        $source = ob_get_contents();
        ob_end_clean();
        return "data:image/png;base64," . base64_encode($source);
    }
}
