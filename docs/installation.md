## 1. Install
##### requirement:

    * docker (19.03+)
    * docker-compose (1.26+)
    * GNU make

##### clone the project:

```bash
$ git clone https://github.com/louzet/ikigai-test.git
$ cd ikigai-test
```

##### project initialization:
Launch the project initialization with the ```make start``` command.

```bash
$ make start
```

Please wait, it may take a while.

When the docker environment is ready, you can use the ```make ps``` command to view your containers and their state.

##### services:
    * symfony app
    * nginx, PORT 8000
    * db (mysql:8.0) PORT 3307
    * phpmyadmin, PORT 3308

##### tests:
The application is provided with some basics unit tests, you can check it with another command.

```bash
$ make test
```

[Next : 2. project architecture](project-architecture.md)