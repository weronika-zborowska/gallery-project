# Galeria zdjęć
Projekt zaliczeniowy wykonany w Symfony. Aplikacja umożliwia przeglądanie galerii zdjęć, dodawanie komentarzy przez niezalogowanych użytkowników oraz zarządzanie treściami przez administratora.

# Dane logowania:
Administrator:

e-mail:admin@example.com
hasło: admin123

# Uruchomienie projektu:

```bash
docker compose up -d
docker compose exec php bash
cd app
composer install
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load