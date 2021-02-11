<?php
class Database {
  public static $host = 'localhost';
  public static $dbname = 'Ski_service';
  public static $port = '3306';
  public static $unix_socket = null;
  public static $charset = 'utf8';
  public static $usernames = ['root', 'root', 'root'];
  public static $passwords = [null, null, null];

  public static function connect(int $usernameid = 0)
  {
    // DSN zusammensetzen
    $dsn = 'mysql:';
    if (isset(self::$host)) {
      $dsn .= 'host=' . self::$host . ';';
    }
    if (isset(self::$port)) {
      $dsn .= 'port=' . self::$port . ';';
    }
    if (isset(self::$dbname)) {
      $dsn .= 'dbname=' . self::$dbname . ';';
    }
    if (isset(self::$unix_socket)) {
      $dsn .= 'unix_socket=' . self::$unix_socket . ';';
    }
    if (isset(self::$charset)) {
      $dsn .= 'charset=' . self::$charset . ';';
    }
    $dsn = substr($dsn, 0, strlen($dsn) - 1);

    // BenutzernameID validieren
    if (count(self::$usernames) <= 0 || count(self::$passwords) <= 0) {
      throw new RangeException('Es wurden keine Login-Informationen angegeben!');
    }
    if ($usernameid >= count(self::$usernames) || $usernameid >= count(self::$usernames)) {
      $usernameid = 0;
    }

    // Verbindung aufbauen
    $username = self::$usernames[$usernameid];
    $password = self::$passwords[$usernameid];
    return new PDO($dsn, $username, $password);
  }
}
?>