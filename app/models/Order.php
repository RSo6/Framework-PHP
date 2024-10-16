<?php

namespace app\models;

use Exception;
use wfm\App;
use PHPMailer\PHPMailer\SMTP;
use RedBeanPHP\R;
use PHPMailer\PHPMailer\PHPMailer;
class Order extends AppModel
{

    public static function saveOrder($data): int|false
    {
        R::begin();
        try {
        $order = R::dispense('orders');
        $order->user_id = $data['user_id'];
        $order->note = $data['note'];
        $order->total = $_SESSION['cart.sum'];
        $order->qty = $_SESSION['cart.qty'];
        $order_id = R::store($order);

        self::saveOrderProduct($order_id, $data['user_id']);

        R::commit();
        return $order_id;
        } catch (\Exception $e) {
            debug($e->getMessage(), 1);
            R::rollback();
            return false;
        }
    }

    public static function saveOrderProduct($order_id, $user_id)
    {
        $sql_part = '';
        $binds = [];
        foreach ($_SESSION['cart'] as $product_id => $product) {
            //якщо цифровий товар
            if ($product['is_download']) {
                $download_id = R::getCell(
                    "SELECT download_id 
                            FROM product_download 
                            WHERE product_id = ?",
                            [$product_id]
                );
//                debug($product_id, 1);
//                debug($product,1);
//                debug($product['is_download']);
                $order_download = R::xdispense('order_download');
                $order_download->order_id = $order_id;
                $order_download->user_id = $user_id;
                $order_download->product_id = $product_id;
                $order_download->download_id = $download_id;

                R::store($order_download);
//                debug($download_id,1);
            }
            $sum = $product['qty'] * $product['price'];
            $sql_part .= "(?,?,?,?,?,?,?),";
            $binds = array_merge($binds, [
                $order_id, $product_id,
                $product['title'], $product['slug'],
                $product['qty'], $product['price'],
                $sum]);
        }
//        debug($_SESSION, 1);
        $sql_part = rtrim($sql_part,',');
        R::exec("INSERT INTO order_product (order_id, product_id, title, slug, qty, price, sum)
        VALUES $sql_part", $binds);
    }

    public static function mailOrder($order_id, $user_email, $tpl): bool
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host       = App::$app->getProperty('smtp_host');
            $mail->SMTPAuth   = App::$app->getProperty('smtp_auth');
            $mail->Username   = App::$app->getProperty('smtp_username');
            $mail->Password   = App::$app->getProperty('smtp_password');
            $mail->SMTPSecure = App::$app->getProperty('smtp_secure');
            $mail->Port       = App::$app->getProperty('smtp_port');
            $mail->isHTML(true);
            //Recipients
            $mail->setFrom(App::$app->getProperty('smtp_from_email'), App::$app->getProperty('site_name'));
            $mail->addAddress($user_email);

            $mail->Subject = sprintf(___('cart_checkout_mail_subject'), $order_id);
            ob_start();
            require \APP . "/views/mail/{$tpl}.php";
            $body    = ob_get_clean();
            $mail->Body  = $body;
            return $mail->send();
        } catch (Exception $e) {
            debug($e,1);
            return false;
        }
    }


}