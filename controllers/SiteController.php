<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Mailer;
use app\core\Request;
use app\core\SmsMailer;
use app\models\Message;

class SiteController extends Controller
{
    public function home(Request $request)
    {
        $model = new Message();

        if ($request->isPost()) {
            $model->loadData($request->getBody());

            if (Application::$app->session->validateToken($request->getBody()['token'])) {
                if ($model->validate() && $model->save()) {
                    Application::$app->session->setFlash('success', 'Message saved');

                    (new Mailer())
                        ->setTo('test_receiver@domen.com')
                        ->setFrom('test_recepient@domen.com')
                        ->setSubject('Message stored')
                        ->setMessage('Hi it is my first mailer, Please message me if you restive this letter, Thank you very mach! Message:' . $model->message)
                        ->send();

                    (new SmsMailer('sms_domen.com'))
                        ->setTo('101234567890')
                        ->setFrom('201234567890')
                        ->setMessage($model->message)
                        ->send();
                }
            }
        }

        return $this->render('home', [
            'model' => $model
        ]);
    }
}