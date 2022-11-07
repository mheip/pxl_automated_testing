## Setup

Om te starten met ontwikkeling voor deze les moet je beginnen met het volgende commando uit te voeren:
```
lando start
```
Deze gaat uw Docker containers opzetten, Laravel downloaden met composer en ook in één keer de App Key van Laravel generaten.

## Lando tooling
Om tests uit te voeren maken we gebruik van de lando tooling mogelijkheden.
Dit wil zeggen dat we in onze .lando.yml file bepaalde tooling commands hebben toegevoegd die achterliggend commando's in de docker container gaan uitvoeren.

Read more: https://docs.lando.dev/config/tooling.html

## GrumPHP
GrumPHP is een tool die instaat voor code quality binnen het project maar van zichzelf geen tests bevat.
Het gaat echter allerlei verschillende tests zoals PPHStan, PHPCS, PHPUnit, enzovoort bundelen en uitvoeren bij commits met behulp van git-hooks.

Deze gaat er ook voor zorgen dat we tests conditioneel kunnen uitvoeren, zoals PHPStan enkel uitvoeren als we een PHP-file aanpassen,
of yamllint bij aanpassingen in .yml files.

Achteraf toevoegen van tests word ook eenvoudiger aangezien we hiervoor dan geen git-hook moeten aanpassen.

Read more: https://github.com/phpro/grumphp

## PHPStan
