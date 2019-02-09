# Testaufgabe
Für eine Liste von Produkten, zum Beispiel in einem Warenkorb, erstelle eine Berechnung der Gesamtsumme für den Warenkorb. Die Summe soll sowohl als Bruttopreis als auch Nettopreis zurückgegeben werden.  
__Details:__  
Erstelle eine Klasse Product, die ein Produkt in einem fiktiven e-commerce System beschreibt. Ein Produkt ist mindestens definiert durch einen Namen, Preis und Steuersatz. 
Für eine Liste von Produkten, e.g. aus einem Warenkorb, soll die zu zahlende Summe als Brutto- und Nettobetrag ausgegeben werden können.  

**Lösung:**  
Der Test "\App\Tests\Integration\Component\Checkout\CashRegisterTest" stellt dar wie die Summe einer Menge von Produkten berechnet werden kann.
Wie gewünscht gibt es den Nettopreis und den Bruttopreis zurück, wobei bei der Berechnung natürlich die unterschiedlichen MWST-Sätze beachtet werden.
Das System ist momentan nur darauf ausgelegt mit einer Währung umzugehen. Allerdings kann es recht einfach erweitert werden um mit weiteren Währungen zu arbeiten.  

## Nutzung

### Image bauen
`docker build -t mhergerdt/testaufgabe .`

### Tests ausführen
**Beachten:** Hier wird der Code in dem gebauten Image getestet.

`docker run mhergerdt/testaufgabe vendor/bin/simple-phpunit -c phpunit.xml.dist`

Um nach Änderungen den Code zu testen gibt es zwei Optionen:
1. Das Image neu bauen und dann die Tests ausführen
2. Das Projekt mittels "volume" in den Container bringen und die Tests laufen lassen:  
   Linux:  
   `docker run -v $(pwd):/var/www/project mhergerdt/testaufgabe vendor/bin/simple-phpunit -c phpunit.xml.dist`  
   Windows:  
   `docker run -v %cd%:/var/www/project mhergerdt/testaufgabe vendor/bin/simple-phpunit -c phpunit.xml.dist`  
