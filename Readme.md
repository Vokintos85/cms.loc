

## 1 Запуск локально

В корне проекта выполнить:
```shell
php -S 127.0.0.1:9000
```
## 2 Запуск базы данных

В любом месте WSL
```shell
docker run --rm \
  --name cms.loc \
  -e MYSQL_DATABASE=cms \
  -e MYSQL_USER=dcms \
  -e MYSQL_PASSWORD=cms \
  -e MYSQL_ROOT_PASSWORD=cms \
  -v mysql-test-data:/var/lib/mysql \
  -p 3306:3306 \
  mysql:8

```