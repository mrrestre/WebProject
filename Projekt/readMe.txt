login css 

admin css 

registration css:  das Text muss neben der Formular stehen

contact css: der footer Problem, ich konnte es nicht kriegen ihn fest zu machen 

Profile css: ist fertig, es müsste nur bei php geprüft ob der Nutzer frau oder mann um das Avatarbild anzupassen 

addArticle css

responsive noch nicht gemacht 
p.s. ich hasse css 

____________________________________

Javascript:

Login: es wurde geprüft wenn das Passwort kleiner als 6 buchstaben aber das E-mail ist schon durch html geprüft (regEx)..
	Update: hat funktioniert erstmal und dann nicht mehr(ich hab nichtssssss geändert nichts)

registration.js: teilweise funktioniert nicht bei namen kürzer als 3 buchstaben...,aber es funktioniert nur bei unterschiedliche 
	      passwörter funktioniert, und lädt die Seite neu obwohl ich  preventDefault(); benutzt.
	      preventDefault(); hab ich in login.js benutzt un hat funktioniert 
deleteUser.js: wurde nur das Löschen prozess bestätigt bevor es ausgeführ wird



also validierung der Formulare mit javascript ist noch nicht fertig, du kannst css fertig machen uns am Montag kann ich damit
weiter machen, viel spaß noch  

____________________________________

22.02.2020

WICHTIG: DatenBank hat neue daten, also nochmal importieren

Gemacht: 
- Bei Registrierung muss das Email nicht vorhanden sein, Das passwort hat auch Regex in PHP    👍👍👍👍👍👍
- CSS überall gemacht. Falls du findest, irgendwo wo es nicht so gut aussieht oder so, sag mir 👍👍👍👍👍👍
  o noch deleteUser
  o ich finde bei login müssen die felder nicht so breit sein
  o bei Contact der Text am rechten seite ist so weit nach rechts, könnte ein bisschen so in der Mitte sein
  o und bei registration auch der text box ist so weit oben, weil theorethich wenn man die Formular ausfüllt scrollt ein bisschen 
    nach unten und er muss das immer ungefähr in der Mitte sehen
  *** die sind alle kleinichkeiten, wenn sie so viel zeit kosten werden mach das nicht, es sieht trotzdem gut aus. 
- Responsiv auch uberäll aber auch bitte prüfen 👍👍👍👍👍👍
- Suche Implementiert, mann kann in Contect, Tittel, Kategorie und Author.Firstname suchen alles auf einmal 👍👍👍👍👍👍
- Footer bleibt immer ruhig 👍👍👍👍guuuut👍👍👍👍
- Filter  reingebaut, man kann nur eine categorie ausählen, ich will es mit radiobox tauschen, aber heute habe ich kein Bock mehr
  Morgen mache ich weiter damit, ich bin mir nicht sicher von design aber
  o hast du mit drop down navi probiert ? 
- Ein paar Artikel und sache in DatenBank Importiert 👍👍👍👍👍👍

________________________________________

23.02.2020

DatenBank nochmal importieren, nicht so viele ergänzungen
Neue Standart Passwort für neue Users: Aa##123123

Gemacht:
-Man kann jetzt artikel Kaufen.
    -Dafür gibt es jetzt eine neue Seite buyArticle
    -Man kann das nicht so trick machen um artikel lesen mit URL (Redirect)
    -Man kann eine neue Payment method hinzüfugen
    -CCV funktioniert in creditkarte nicht wie es sollte (Kein Bock zu suchen)
    -Price wurde ergänzt zu den artikel (Wenn vorhanden)
    -Wurde ein artikel schon von dem Nutzen gekauft, kommt nicht der Preis
-Delete User hat CSS
-Error 404 überasching, schau mal rein
-Versucht mit AJAX im home die Filter anzuwenden, ging nicht! :(
-Registrierung hat erinnerung jetzt, es wird nicht alles gelöscht wenn irgendwas falsch ist
-Allgemin anpassungen in CSS und in PHP (Habe vergessen was ich noch heute gemacht habe)

TODO(Dringend):
- Irgendwas nachladen mit AJAX ?? ich wollte im Home aber ich weis nicht wie und heute bin ich tot
- Formulare mit AJAX schicken
- htmlspecialcharacters bei jede ausgabe (Ist langweillig, ich kann es auch irgendwann machen)
- Soviel testen wie möglich, alles was und einfällt
- Code Einigermaßen dokumentieren (Funktionene habe ich schon gemacht)
- Dokumentation in HTML in Footer anbinden und machen!! 
- Ein Formular muss mehrseitig sein (Steht bei Kruse)

________________________________________

					24.02.2020
###### js formulare validation ########

-login: ist schon von dem Browser geprüft.
-registration JS Validieren:
		der Name und Nachname dürfen nicht leer sein und  müssen mind. 3 Buchstaben enthalten
		die Telefonnummer < 14
		Passwörter müssen das gleiche sein
-contact: wurde gemacht, bei html hab ich required attribut für message gelöscht aber wird durch JS geprüft.
	 kommt alert was soll ausgefüllt werden und wird der Border rot.
-deleteUser: wird alert gezeigt um das delete Peozess zu bestätigen		
-addArticle: fertig. title, teaser und content haben bestimmte große
	    imageName darf nicht leer sein 
-updatePassword: die 2 passwörter müssen das selbe sein
_______________________________________

- Formulare mit AJAX schicken
  min. 1 Formular wie Registation:
  hab genau eins zu eins wie in der Folien steht aber hat nicht funktioniert 

  contact: hat auch nicht funktioniert.
_______________________________________

htmlspecialchars():

-login
-contact hat keine php behandlung sondern action="mailto..." deswegen ist aufwendig das hier zu anwenden
-registration
-addArticle mit value attribute

_______________________________________

 noch TODO(Dringend):

- Irgendwas nachladen mit AJAX ?? ich wollte im Home aber ich weis nicht wie und heute bin ich tot
- Ein Formular muss mehrseitig sein (Steht bei Kruse)

- Code Einigermaßen dokumentieren (Funktionene habe ich schon gemacht)
- Dokumentation in HTML in Footer anbinden und machen!! 
- Soviel testen wie möglich, alles was und einfällt






