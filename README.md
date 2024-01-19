# Admin Database Provider

**Admin Database Provider** — это сервис, который обеспечивает интеграцию между проектами и административной панелью Generative Projects.

## Установка

1. Установите модуль с помощью Composer, добавив следующую зависимость в раздел `require` файла `composer.json`:

    ```
    "generative/admin-database-provider": "^1.0"
    ```

2. Добавьте в файл `composer.json` раздел для указания репозитория:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "GIT_URL"
        }
    ],
    ```

3. Обновите зависимости composer:

    ```bash
    composer update
    ```

4. Создайте API токен в настройках GitHub по [ссылке](https://github.com/settings/tokens/new?scopes=repo&description=Composer+API+KEY).

5. Выполните команду для публикации конфигурационного файла:

    ```bash
    php artisan vendor:publish --tag=admin-config --ansi --force
    ```

## Настройка

Настройку видимости таблиц и столбцов можно регулировать в файле `config/admin_panel.php`.

## Обновление модуля

```
git tag -a 1.0.0 -m "Commit message"
git push origin 1.0.0
```

