DOCKER_CONTAINER_NAME=shopping-app

.PHONY: install
install:
	docker exec -ti ${DOCKER_CONTAINER_NAME} symfony composer install

var/log:
	mkdir -p var/log

.PHONY: run
run: var/log
	docker-compose up --build -d

.PHONY: db
db:
	docker exec -ti ${DOCKER_CONTAINER_NAME} symfony console d:d:c >/dev/null || true
	docker exec -ti ${DOCKER_CONTAINER_NAME} symfony console d:s:u --force
	docker exec -ti ${DOCKER_CONTAINER_NAME} symfony console d:f:l 



