<?php

namespace app\api\controllers;

use app\api\models\Users;
use app\web\models\User;
use app\api\components\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class UsersController
 * @package app\api\controllers
 */
class UsersController extends Controller
{
    /**
     * @return string
     */
    public function actionGetList(): string
    {
        $users = User::findAll([], true);
        return json_encode($users);
    }

    /**
     * @return string
     */
    public function actionCreate(): string
    {
        $user = new User();
        $user->load($_POST);

        return $user->save() ? 'OK' : 'FAIL';
    }

    public function actionExport()
    {
        $file = __DIR__ . '/../storage/users_' . time() . '.xlsx';
        Users::export($file);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.adm.tools';
            $mail->SMTPAuth = true;
            $mail->Username = '0812.shop@tiba.in.ua';
            $mail->Password = 'jGA22r61JeNv';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('0812.shop@tiba.in.ua');
            $mail->addAddress($_GET['email']);

            $mail->addAttachment($file);

            $mail->isHTML(false);
            $mail->Subject = '0812 shop users list';
            $mail->Body    = 'This is the mail with shop users list in attachment';

            $mail->send();
        } catch (Exception $exception) {
            $this->error(500, "Email can not be sent: {$exception->getMessage()}");
        }

        return $this->success('Users exported');
    }
}
