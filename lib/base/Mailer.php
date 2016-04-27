<?php

require_once(ROOT . DS . 'lib' . DS . 'base' . DS . 'PHPMailer' . DS . 'class.phpmailer.php');    
    
class Mailer {
    
    /**
     * PHPMailer object reference.
     */
    private $mailer;
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Set the mailer, session and request objects references to class properties.
     * @param PHPMailer $mailer
     * @param Session $session
     * @param Request $request
     */
    public function __construct(PHPMailer $mailer, Session $session, Request $request) {
        $this->mailer = $mailer;
        $this->session = $session;
        $this->request = $request;
    }
    
    /**
     * Send account activation code via email uppon registration.
     * @param string $name - name of the user
     * @param string $email
     * @param string $activationCode 
     */
    public function sendActivationCode($name, $email, $activationCode) {
        $toName = "{$name}";
        $to = "{$email}";
        $subject = 'Account Activation';
        $message = "Thank your for registering at nature.dev. To activate your account please click the link below.\n\n";
        $message .= 'http://nature.dev/activate/index?' . 'email=' . urlencode($email) . '&activationCode=' . $activationCode;
        $fromName = 'Admin';
        $from = 'admin@bookstore.com';
        $this->mailer->FromName = $fromName;
        $this->mailer->From = $from;
        $this->mailer->AddAddress($to, $toName);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $message;
        if (!$this->mailer->Send()) {
            $this->session->flash('error', 'You could not be registered due to system error. We apologize for any inconvenience.');
            $this->request->redirect();
        } else {
            $this->session->flash('success', 'Thank you for registering! A confirmation email with activation code has been send to your email address.');
            $this->request->redirect();
        }
    }
    
    /**
     * Send email to admin from submitted contact form.
     * @param string $name - the name of the sender
     * @param string $email - the email address of the sender
     * @param string $message
     */
    public function sendMailToAdmin($name, $email, $message) {
        $to = 'admin@nature.dev';
        $subject = 'User Inquiry';
        $this->mailer->FromName = $name;
        $this->mailer->From = $email;
        $this->mailer->AddAddress($to);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $message;
        if (!$this->mailer->Send()) {
	$this->session->flash('error', 'Your message was not send duo to system error. Please try again later.');
	$this->request->redirect();
        } else {
	$this->session->flash('success', 'Thank you for contacting us. We will give our best and reply as soon is possible.');
	$this->request->redirect();
        }
    }
}
