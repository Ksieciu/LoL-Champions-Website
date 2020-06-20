Dokumentacja techniczna dla projektu strony opartej na architekturze mikroserwisowej SOAP i REST.

Autorzy:
Sebastian Winiarski
Piotr Wróblewski




1.Założenia projektu

Założeniem projektu jest stworzenie serwisów SOAP i REST oraz implementacji klienta wykonującego operacje CRUD oparte na mikroserwisach. Za tło projektowe przyjęliśmy portal do wyświetlania informacji na temat jednej z popularnych gier komputerowych typu MOBA. 

2. Wykorzystane technologie

a.	Technologie Backend’owe - PHP, MySQL
b.	Technologie Frontend’owe - HTML, CSS, JavaScript

Celowo nie zostały wykorzystane żadne dodatkowe frameworki.

3. Opis struktury projektu

Projekt podzielony został na szereg głównych katalogów, podzielonych ze względu na typ przechowywanych plików, bądź to jaką funkcje pełnią one w projekcie.
•	Folder „css” służy do przechowywania arkuszu styli
•	Folder „functions” służący przechowywaniu funkcji pobierających i wyświetlających dane z serwisów SOAP oraz REST
•	Folder „‘images” służy do przechowywania wewnętrznych elementów graficznych szablonu
•	Folder „layouts” przechowuje pliki będące odpowiedzialne za prawidłowe wyświetlanie elementów nawigacyjnych strony czy sekcji footer
•	Folder „php-chemipns-rest-api” – część REST’owa projektu
•	Folder „php-soap-account” – część SOAP’owa projektu
•	Folder „scripts” – skrypt nawigacyjny
•	Folder domowy przechowuje widoki witryn, favicon oraz dokumentacje techniczną 
4. Podział prac

Z uwagi na wymagania projektu, nie dzieliliśmy pracy tak, by jedna osoba robiła w całości Frontend, a druga Backend. Staraliśmy się by każdy z nas stworzył swoją część przy tworzeniu serwisów SOAP i REST. 
 


4.1 Piotr Wróblewski

-Przygotowanie oraz opracowanie strony wizualnej całego projektu
•	Przygotowanie szaty graficznej projektu
•	Dobór fontów oraz ich implementacja
•	Zadbanie o spójna kolorystykę względem identyfikatora wizualnego
•	Przygotowanie contentu strony
-Zaprowadzenie głównego szablonu html wraz z arkuszem stylów
-Podstawowa wersja wszystkich stron i podstron HTML ( następnie przerobionych na PHP)
•	details.php
•	index.php
•	login.php
•	register.php
-Przystosowanie wyświetlanych wyników do wyglądu strony
- Część REST’owa:
•	Monster.php
•	Funkcje związane z pobieraniem Monsters przez API



4.2 Sebastian Winiarski

- Utworzenie części serwisu REST:
1.	Models i Config:
•	Database.php
•	Champion.php
•	Buff.php
2.	Api/champion:
•	Wszystkie funkcje związane z champion
•	Wszystkie funkcje związane z buff

- Klient aplikacji:
1.	Register.php
2.	Logout.php
4.3 Praca wspólna
	
•	utworzenie serwisu SOAP „php-soap-account” – Server.php
•	utworzenie klienta pobierającego dane z serwisu SOAP – Client.php
•	DataManager.php
•	MonsterManager.php
