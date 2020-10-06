<?php

require_once 'validator.php';
require_once 'ContactMailer.php';

$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
$phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : null;
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : null;

if (empty($email) || empty($phone) || empty($message)) {
  echo 'Все поля обязательны для заполнения.';
  exit;
}

if (!Validator::isValidEmail($email)) {
  echo 'E-mail не соответствует формату.';
  exit;
}

if (!Validator::isValidPhone($phone)) {
  echo 'Телефон не соответствует формату.';
  exit;
}

if (ContactMailer::send($email, $phone, $message)) {
  echo 'Ваше сообщение успешно отправлено.';
} else {
  echo 'Произошла ошибка! Не удалось отправить сообщение.';
}
exit;