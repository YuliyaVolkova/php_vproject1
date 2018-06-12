*ВЫПУСКНОЙ ПРОЕКТ*: №1 по курсу PHP

*Выполнила*:  Волкова Юлия

*Проверил*: Дмитрий Руденский

*АДМИН-ПАНЕЛЬ*: admin.php.

*Cкрипт для обработки формы*: data/form.php.

*Настройки БД в файле*: data/login.php.

*Current database*: burgers.

*Структура таблиц*: 

*Table customers*:
| Field | Type         | Null | Key | Default | Extra |

| email | varchar(128) | NO   | PRI | NULL    |       |

| name  | varchar(255) | NO   |     | NULL    |       |

| phone | varchar(128) | NO   |     | NULL    |       |


*Table orders*:

| Field           | Type                 | Null | Key | Default | Extra          |

| orderid         | int(11)              | NO   | PRI | NULL    | auto_increment |

| customeremail   | varchar(128)         | NO   | MUL | NULL    |                |

| dateorder       | timestamp            | YES  |     | NULL    |                |

| shippingaddress | varchar(255)         | YES  |     | NULL    |                |

| typepaid        | enum('cashe','card') | YES  |     | NULL    |                |

| recall          | enum('none','yes')   | YES  |     | NULL    |                |

| ordercomments   | tinytext             | YES  |     | NULL    |                |
