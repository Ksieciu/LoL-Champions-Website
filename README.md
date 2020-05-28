# LoL-Champions-Website

Na tę chwilę zrobione jest proste REST API do zarządzania championami - bez statystyk i tagów(specjalizacji). 
API zawiera operacje GET, POST, PUT, DELETE na championach.
To API jest stworzone w PHP przy pomocy microframeworka Lumen.

Do działania potrzeba:
1. PHP 7.4 lub nowsze
2. Composer

Dla pewności, że zadziała na nowym komputerze, można zrobić pusty projekt Lumen, by mieć pewność, że composer zaintaluje wszystkie potrzebne elementy:
composer create-project --prefer-dist laravel/lumen test


Serwer można odpalić komendą:
php -S localhost:8000 -t public

Do działania jest potrzebna baza danych - informacje o niej do ustawienia w pliku .env