<?php

namespace app\core;

class SmsMailer extends Mailer
{

    private string $domainName;

    public function __construct(string $domainName)
    {
        $this->domainName = $domainName;
    }

    public function setTo($data)
    {
        if (is_array($data)) {
            $emails = array_map([$this, 'toEmail'], $data);
            $this->to = implode(', ', $emails);
        } else {
            $this->to = $this->toEmail($data);
        }

        return $this;
    }

    private function toEmail($data){
        return $data . '@' . $this->domainName;
    }

}