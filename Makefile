.PHONY: *

DOCKER=
DOCKER_CONTAINER_NAME=shopping-app
ifeq ("$(wildcard /.dockerenv)","")
DOCKER=docker exec -ti ${DOCKER_CONTAINER_NAME}
endif

install:
	${DOCKER} composer install

run:
	docker-compose up --build -d

bash:
	${DOCKER} bash
