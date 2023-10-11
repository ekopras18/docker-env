## Run db

1. cd database/

    ```bash
    sudo docker-compose -f db.yaml up -d
    ```

- untuk remove container

  ```bash
  sudo docker-compose -f db.yaml down -v
  ```

2. Setup Penyesuaian mariadb/mysql

- edit file <b>/etc/mysql/mariadb.conf.d/50-server.cnf</b> dan sesuaikan baris berikut :

  ```bash
  add "innodb-strict-mode=OFF" in [mysqld] section
  ```

  ```bash
  # These groups are read by MariaDB server.
  # Use it for options that only the server (but not clients) should see

  # this is read by the standalone daemon and embedded servers
  [server]

  # this is only for the mysqld standalone daemon
  [mysqld]
  innodb-strict-mode=OFF <--- add this line
  #
  # * Basic Settings
  #
  ```
## Run Apache

2. cd apache/

    ```bash
    sudo docker-compose up -d
    ```

- untuk remove container

  ```bash
  sudo docker-compose down -v
  ```
## Source Project (Lokasi Project)

3. <b>apache/src/</b> (for php apps standalone) and <b>src/</b> (for laravel apps) 

## Melihat log

  ```bash
  sudo docker-compose logs -f <nama_container>
  ```
## Masuk ke container

```bash
sudo docker exec -it <nama_container> /bin/bash
```

## Stop Container

```bash
sudo docker stop <nama_container>
```

## cek

```bash

sudo docker exec -it <nama_container> /bin/bash -c "cat /lokasi/name_file.extention"

```