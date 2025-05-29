# Примеры запросов к API

## Список организаций в здании
curl -H "X-API-KEY: secret"   http://127.0.0.1:8000/api/company/building/24

## Организации по виду деятельности
curl -H "X-API-KEY: secret" http://127.0.0.1:8000/api/company/activity/3

## Организации в радиусе
curl -H "X-API-KEY: secret" http://127.0.0.1:8000/api/company/nearby

## Информация об организации
curl -H "X-API-KEY: secret" http://127.0.0.1:8000/api/company/1

## Поиск по виду деятельности
curl -H "X-API-KEY: secret" "http://127.0.0.1:8000/api/company/type?name=%D0%95%D0%B4%D0%B0"

## Поиск по названию организации
curl -H "X-API-KEY: secret" "http://127.0.0.1:8000/api/company/name?name=%D0%9A%D0%B0%D1%84%D0%B5"

## Список зданий
curl -H "X-API-KEY: secret" http://127.0.0.1:8000/api/buildings


# Docker

## Сборка образа
docker build -t blog .

## Запуск контейнера
docker run -d -p 8000:80 --name blog blog
