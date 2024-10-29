### Komentarze do zastosowanych rozwiązań i ew. objaśnień:
1. Przy tworzeniu endpointa dla API, rozważałem dwa rozwiązania:
    - pobranie kursów dla wszystkich walut, a następnie foreachem wyciągnięcie z niej tylko interesujących nas kursów
    - pobieranie kursu indywidualnie dla każdej waluty
2. Ze względu na małą ilość walut które pobieramy, wykonałem drugie z ww. rozwiązań. Jeśli liczba walut była by dużo większa, wówczas zdecydował bym się na pierwsze rozwiązanie.
3. Przy serializowaniu obiektów dla response w API, mimo wszystko zdecydowałem się dodać paczkę serializatora aby transformować obiekty do json'a. Alternatywnie można było to wykonać funkcjami `__toString()` zdefiniowanymi w serializowanych obiektach
4. W plikach JS można zauważyć że przedefiniowałem url aplikacji na 127.0.0.1:8000 - wynika to z tego że ze względu na niską wydajność webserwera stawianego na windowsie przez dockera, uruchamiałem go nie przez dockera, a przez domyślny serwer symfony uruchamiany poprzez polecenie `symfony server start`

---
### Czego zabrakło
1. Testów aplikacji dla endpointa do pobierania kursów - potencjalne przypadki testowe mogłbyby obejmować sprawdzanie czy istnieją kursy dla paru przypadkowych walut, czy kurs sprzedaży w przypadku walut innych niż euro i dolar wynoszą `null`, czy różnice w kursie sprzedaży i kupna, bądź różnice w kursie średnim i kupna, są zgodne z założeniami aplikacji.
2. Zapisywanie wybranej daty kursu do URL-a - miałem problem z operowaniem na `history.replace` natomiast nie chciałem robić tej funkcji opierając się na czystym JS'ie zamiast reacta.

---
### Feedback do zadania i podsumowanie czasu pracy

Zadanie zajęło mi następującą ilość czasu:
- Backend: około 2.5h
- Frontend: około 3.5h
- Konfiguracja oraz napisanie podsumowania: około 1h
- Całość pracy to około 8h

Jeśli chodzi o feedback do samego zadania: bardzo podobało mi się skupienie zarówno na kwestie frontendoych jak i backendowych. Fajna czytelna instrukcja instalacji paczki i format zadania (tworzenie tego nie jako całkiem nowe repo na githubie, ale jako fork do istniejącego i skonfigurowanego repozytorium - tak że można skupić się w całości na zadaniu pomijając aspekt instalacji i konfigurowania Symfony.
Z rzeczy do których mógłbym się przyczepić to wersja PHP wykorzystywana w zadaniu - ze względu na większą wygodę w nowszych wersjach (np. typowanie, union type, switch case) rozważył bym zaktualizowanie zadania aby wykorzystywało PHP >= 8.0. Chyba że wersja 7.2 jest uzasadniona tym, że np. wykorzystujecie ją obecnie w Waszych istniejących projektach - wówczas sprawdzanie wiedzy pod tę konkretną wersję jest jak najbardziej zrozumiałe.

Dziękuję za możliwość wykonania zadania, gdyż pod względem organizacji i przygotowania wyróżniało się pośród innych które miałem okazję wykonywać. 