<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';
/**
 * Mailer: класс-хелпер, отправляет почту администратору
 */
class ContactMailer
{
  /**
     * E-mail отправителя
     * @var string
     */
    private static $emailFrom = ' ';
    /**
     * E-mail получателя
     * @var string
     */
    private static $emailTo = ' ';

    /**
     * @param string $email
     * @param string $phone
     * @param string $message
     * @return boolean
     */
    public static function send($email, $phone, $message)
    {
    // Формируем тело письма
    $body = "E-mail: " . $email . "\nТелефон: " . $phone . "\n\nСообщение:\n" . $message;

    // Создаем объект PHPMailer
        $mailer = new PHPMailer();
        // Настройки подключения
        $mailer->isSMTP();
        // Устанавливает хост почтового сервера (Mail.ru: smtp.mail.ru, Google: smtp.gmail.com)
        $mailer->Host = 'smtp.yandex.ru';
        // Включает SMTP-авторизацию
        $mailer->SMTPAuth = true;
        // Логин или E-mail целиком
        $mailer->Username = ' ';
        // Пароль от почтового ящика
        $mailer->Password = ' ';
        // Протокол соединения
        $mailer->SMTPSecure = 'ssl';
        // Порт для исходящаей почты
        $mailer->Port = '465';

        // Устанавливает кодировку
        $mailer->CharSet = 'UTF-8';
        // Устанавливает E-mail и имя отправителя
        $mailer->setFrom(self::$emailFrom, 'Имя отправителя');
        // Добавляет E-mail получателя
        $mailer->addAddress(self::$emailTo);
        // Настройка HTML-формата
        $mailer->isHTML(false);
        // Тема письма
        $mailer->Subject = 'Заполнена форма обратной связи';
        // Основное тело письма
        $mailer->Body = $body;
        
        // Отправляет письмо
        if ($mailer->send()) {
        	return true;
        }
    	return false;
    }
}