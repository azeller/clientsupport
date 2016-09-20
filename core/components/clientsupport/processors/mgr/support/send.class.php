<?php
/**
 * Send the support form via email
 *
 * @package clientsupport
 * @subpackage processors
 */

class ClientSupportSendProcessor extends modProcessor
{
    public function process()
    {
        $name = $this->getProperty('name');
        $email = $this->getProperty('email');
        $problem = $this->getProperty('problem');
        $description = $this->getProperty('description');

        $browser = get_browser(null, true);
        $user = $this->modx->user->get('username');
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $message = $description;
        $message .= "\n\n";
        $message .= print_r($browser, true);
        $message .= 'Browser: '.$browser['parent']."\n";
        $message .= 'Platform: '.$browser['platform']."\n";
        $message .= 'Page: '.'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"."\n";
        $message .= 'Username: '.$user."\n";
        $message .= 'IP address: '.$ip_address."\n";

        $emailTo = 'joeke@sterc.nl';
        $emailFrom = 'joeke@sterc.nl';

        $this->modx->getService('mail', 'mail.modPHPMailer');
        $this->modx->mail->set(modMail::MAIL_BODY, $message);
        $this->modx->mail->set(modMail::MAIL_FROM, $emailFrom);
        $this->modx->mail->set(modMail::MAIL_FROM_NAME, $name);
        $this->modx->mail->set(modMail::MAIL_SUBJECT, $problem);
        $this->modx->mail->address('to', $emailTo);
        $this->modx->mail->address('reply-to', $email);
        $this->modx->mail->setHTML(true);
        if (!$this->modx->mail->send()) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'An error occurred while trying to send the email: '.$this->modx->mail->mailer->ErrorInfo);
        }
        $this->modx->mail->reset();
    }
}
return 'ClientSupportSendProcessor';
