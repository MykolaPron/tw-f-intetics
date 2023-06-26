<?php

namespace app\core;

class Mailer
{
    protected string $to;
    private string $subject = '';
    private string $message;
    private array $headers;

    public function send()
    {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }

    public function setTo($data)
    {
        if (is_array($data)) {
            $this->to = implode(', ', $data);
        } else {
            $this->to = $data;
        }

        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function setMessage($message)
    {
        $this->message = wordwrap($message, 70, "\r\n");

        return $this;
    }

    public function setFrom($from)
    {
        $this->headers['From'] = $from;
        return $this;
    }

    public function setXMailer($data)
    {
        $this->headers['X-Mailer'] = $data ?? 'PHP/' . phpversion();
        return $this;
    }
}