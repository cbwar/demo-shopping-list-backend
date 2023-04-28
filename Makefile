.PHONY: *

DOCKER=
DOCKER_CONTAINER_NAME=shopping-app
ifeq ("$(wildcard /.dockerenv)","")
DOCKER=docker exec -ti ${DOCKER_CONTAINER_NAME}
endif

install:
	${DOCKER} composer install
	${DOCKER} php bin/console d:d:c --if-not-exists
	${DOCKER} php bin/console d:m:m -n
	${DOCKER} npm i
	${DOCKER} npm run dev

watch:
	${DOCKER} npm i
	${DOCKER} npm run watch

run:
	docker-compose up --build -d

bash:
	${DOCKER} bash
