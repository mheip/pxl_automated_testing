## Setup

Om te starten met ontwikkeling voor deze les moet je beginnen met het volgende commando uit te voeren:
```
lando start
```
Deze gaat uw Docker containers opzetten, Laravel downloaden met composer en ook in één keer de App Key van Laravel genereren. \
Een snelle test om te zien dat alle tools die we gaan gebruik is het uitvoeren van volgende commando: 
```
lando grumphp run
```

## Lando tooling
Om tests uit te voeren maken we gebruik van de lando tooling mogelijkheden.
Dit wil zeggen dat we in onze .lando.yml file bepaalde tooling commands hebben toegevoegd die achterliggend commando's in de docker container gaan uitvoeren.

Deze worden altijd vooraf gegaan door lando, gevolgt door het commando en eventuele opties
```
lando <command>
```

Read more: https://docs.lando.dev/config/tooling.html

## GrumPHP - A PHP code-quality tool
GrumPHP is een tool die instaat voor code quality binnen het project maar van zichzelf geen tests bevat.
Het gaat echter allerlei verschillende tests zoals PPHStan, PHP_CS, PHPUnit, enzovoort bundelen en uitvoeren bij commits met behulp van git-hooks.

Deze gaat er ook voor zorgen dat we tests conditioneel kunnen uitvoeren, zoals PHPStan enkel uitvoeren als we een PHP-file aanpassen,
of yamllint bij aanpassingen in .yml files.

Achteraf toevoegen van tests word ook eenvoudiger aangezien we hiervoor dan geen git-hook moeten aanpassen.

Read more: https://github.com/phpro/grumphp
### Tooling command
```
lando grumphp run
```
Grumphp kan uitgevoerd worden met bovenstaande commando en gaat voor ons de gedefinieerde tests in `grumphp.xml` uitvoeren. Dat is PHP_CS en PHPStan.
Andere Grumphp commands kunnen uitgevoerd worden door run te vervangen met een ander commando van grumphp: `lando grumphp <command>` 

Achterliggend voert deze het volgende command uit: \
`/app/laravel/vendor/bin/grumphp`

## PHPStan - PHP Static Analysis Tool
Deze tool gaat een statische analyse doen van onze code en zonder het effectief runnen van de code fouten opsporen.
Als ergens een vergelijking gemaakt word tussen een **string** en een **integer** gaat PHPStan een error tonen omdat dit soort vergelijkingen onverwachte resultaten gaat geven.

Binnen PHPStan is er ook zoiets als een `baseline` deze bevat al alle bestaande fouten zodat als we PHPStan later toevoegen aan een project we toch een positief resultaat krijgen.
Als een fout gemaakt is en toegevoegd word aan de baseline dan word deze genegeerd bij de volgende controle, tenzij dat deze opgelost is, dan word dit wel als fout aanschouwt.
Op die manier kan je PHPStan toepassen op oude code en nieuwe code kwaliteit garanderen en gaandeweg oude code opschonen.

Omdat we gebruik maken van Laravel zijn er veel Magic methods en hierdoor zijn we genoodzaakt om een wrapper rond PHPStan te gebruiken, namelijk Larastan.
We spreken hierdoor niet meer van een volledig statische controle maar voor onze les is dit niet noodzakelijk hier verder op in te gaan.

Read more: https://github.com/phpstan/phpstan \
Read more about Larastan: https://github.com/nunomaduro/larastan

### Tooling commands
```
lando phpstan-analyse
```
Deze gaat een analyse uitvoeren van onze PHP-code en het aantal fouten terug geven. \
Achterliggend voert deze het volgende commando uit: \
`/app/laravel/vendor/bin/phpstan analyse --memory-limit=2G`

```
lando phpstan-baseline
```
Met dit commando kunnen we de baseline file `phpstan-baseline.neon` updaten met nieuwe fouten of bestaande fouten verwijderen. \
Achterliggend voert deze het volgende commando uit: \
`/app/laravel/vendor/bin/phpstan analyse --memory-limit=2G --generate-baseline`

## PHP_CS - Tokenizes PHP files and detects violations of a defined set of coding standards.
Elk framework binnen PHP en andere talen maakt gebruik van bepaalde coding standards, 4 spaces of 2 tabs bijvoorbeeld.
PHP_CodeSniffer gaat hierop controles uitvoeren aan de hand van een voorgedefinieerde regel set in `phpcs.xml`.
Bij PHP_CS word ook nog een extra tool opgeleverd, namelijk `PHP Code Beautifier and Fixer` deze gaat proberen PHP_CS fouten automatisch goed te zetten. 

Aangezien we hier met laravel werken hebben we gebruik gemaakt van een al bestaande regelset voor laravel, namelijk `mreduar/laravel-phpcs`.

Read more: https://github.com/squizlabs/PHP_CodeSniffer \
Read more laravel phpcs: https://github.com/mreduar/laravel-phpcs

### Tooling commands
```
lando phpcs
```
Deze gaat de coding standards controleren en foutmeldingen geven als er fouten zijn gemaakt. \
Achterliggend voert deze het volgende commando uit: \
`/app/laravel/vendor/bin/phpcs --filter=GitModified`

```
lando phpcs-fix
```
Deze gaat de coding standard automatisch proberen juist te zetten zodat we minder werk hebben.
Achterliggend voert deze het volgende commando uit: \
`/app/laravel/vendor/bin/phpcbf --filter=GitModified`

## PHP Unit - Testing framework
PHP Unit is een testing framework waarmee we code gaan runnen en controle uitvoeren op wat er terug komt.
Eventuele routes opvragen, zien als daar de juiste tekst op staat, een functie die met bepaalde input de juiste output terug geeft.

### Tooling commands
```
lando test <path-to-file>
```
We voeren lando test uit en geven daaraan het path naar de test mee. Deze test gaat zijn uitgevoerd worden.
Achterliggend voert deze het volgende commando uit: \
`/app/laravel/vendor/bin/phpunit`