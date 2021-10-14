# Errors Search

## Errors messages

Access error log in terminal
```sh
sudo tail -100 /var/log/apache2/error.log
``` 
```sh
[Thu Mar 25 18:53:07.457268 2021] [proxy_fcgi:error] [pid 13295] (70007)The timeout specified has expired: [client ::1:54684] AH01075: Error dispatching request to : (polling)
```

```sh
[Thu Mar 25 19:20:12.519213 2021] [proxy_fcgi:error] [pid 15438] (70007)The timeout specified has expired: [client ::1:55854] AH01075: Error dispatching request to : (polling)
```

```sh
[Thu Mar 25 21:17:02.194736 2021] [mpm_prefork:notice] [pid 646] AH00163: Apache/2.4.38 (Debian) mod_fcgid/2.3.9 configured -- resuming normal operations
[Thu Mar 25 21:17:02.197898 2021] [core:notice] [pid 646] AH00094: Command line: '/usr/sbin/apache2'
[Thu Mar 25 22:03:55.910787 2021] [proxy_fcgi:error] [pid 652] (70007)The timeout specified has expired: [client ::1:40344] AH01075: Error dispatching request to : (polling)

```

```sh
[Thu Mar 25 22:31:59.744941 2021] [mpm_prefork:notice] [pid 646] AH00169: caught SIGTERM, shutting down
[Thu Mar 25 22:34:38.241714 2021] [mpm_prefork:notice] [pid 596] AH00163: Apache/2.4.38 (Debian) mod_fcgid/2.3.9 configured -- resuming normal operations
[Thu Mar 25 22:34:38.243334 2021] [core:notice] [pid 596] AH00094: Command line: '/usr/sbin/apache2'
[Thu Mar 25 22:54:58.471960 2021] [proxy_fcgi:error] [pid 599] (70007)The timeout specified has expired: [client ::1:35854] AH01075: Error dispatching request to : (polling)
```

## Web search solutions

https://www.php.net/manual/fr/function.set-time-limit.php

https://www.php.net/manual/fr/info.configuration.php#ini.max-execution-time
> Votre serveur web peut avoir d'autres configurations de la durée limite d'exécution qui peuvent également interrompre PHP. Apache a une directive Timeout et IIS a une fonction CGI pour cela. Par défaut, elles valent toutes les deux 300 secondes. Reportez-vous à la documentation de votre serveur web pour plus de détails

CECI EST EXACTEMENT NOTRE PROBLEME !!


http://web.mit.edu/rhel-doc/4/RH-DOCS/rhel-rg-fr-4/s1-apache-config.html
> Lors de la configuration du Serveur HTTP Apache, modifiez /etc/httpd/conf/httpd.conf puis rechargez, redémarrez ou arrêtez le processus httpd comme l'explique la Section 10.4.

> Avant de modifier httpd.conf, faites une copie de sauvegarde du fichier original. Ainsi, si vous commettez une erreur lors de la modification du fichier de configuration, vous pourrez toujours utiliser la copie de sauvegarde pour résoudre d'éventuels problèmes.

> Si une erreur est commise et que le serveur Web ne fonctionne pas correctement, passez d'abord en revue les passages modifiés du fichier httpd.conf afin de corriger toute faute de frappe.

> Consultez ensuite le journal d'erreurs du serveur Web, /var/log/httpd/error_log. Selon votre expérience, le journal d'erreurs peut paraître quelque peu difficile à interpréter. Ceci étant, les dernières entrées du journal d'erreurs devraient fournir des informations utiles.

> Les sections suivantes contiennent de brèves descriptions des directives contenues dans le fichier httpd.conf. Ces descriptions ne sont pas exhaustives. Pour obtenir de plus amples informations, reportez-vous à la documentation de l'organisation Apache disponible en ligne à l'adresse suivante : http://httpd.apache.org/docs-2.0/.

> Pour obtenir davantage d'informations sur les directives mod_ssl, reportez-vous à la documentation disponible en ligne à l'adresse suivante : http://httpd.apache.org/docs-2.0/mod/mod_ssl.html.

>10.5.4. Timeout
Timeout définit la durée, exprimée en secondes, pendant laquelle le serveur attend des réceptions et des émissions pendant les communications. La valeur de Timeout est paramétrée sur 300 secondes par défaut, ce qui est approprié pour la plupart des situations.

#### Directive TIMEOUT d'Apache2
https://httpd.apache.org/docs/2.4/fr/mod/core.html#timeout

#### Directives et modules liés à la directive TIMEOUT
https://httpd.apache.org/docs/2.4/fr/mod/core.html#acceptfilter
https://httpd.apache.org/docs/2.4/fr/mod/mod_cgi.html
https://httpd.apache.org/docs/2.4/fr/mod/mod_cgid.html
https://httpd.apache.org/docs/2.4/fr/mod/mod_ext_filter.html

A ne pas modifier (dangereux ou inutile) : 
https://httpd.apache.org/docs/2.4/fr/mod/mod_proxy.html > https://httpd.apache.org/docs/2.4/fr/mod/mod_proxy.html#proxytimeout



## Tests

https://www.php.net/manual/fr/function.flush.php
> flush() peut ne pas être capable d'écraser le schéma du tampon de votre serveur web et ceci n'aura aucun effet sur le tampon du navigateur côté client. De plus, cette fonction n'affecte pas le mécanisme d'affichage du tampon de l'espace utilisateur de PHP. Cela signifie que ob_flush() devrait être appelé avant flush() pour vider les tampons de sortie s'ils sont utilisés.
> 
CECI NE CHANGE RIEN 

http://www.linux-france.org/prj/edu/archinet/systeme/ch16s02.html
> Modification de la directive apache TIMEOUT à 3600 secondes OKAAYYYYYYYY



## Erreur php file content

Warning: file_get_contents(https://api.deezer.com/search?q=artist:&quot;claude-françois&quot;): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad request in /var/www/html/apo-Shabadabada/public/wp-content/plugins/shabadabada/class/Deezer.php on line 113

Warning: Invalid argument supplied for foreach() in /var/www/html/apo-Shabadabada/public/wp-content/plugins/shabadabada/class/Deezer.php on line 121

https://api.deezer.com/search?q=artist:&quot;françoise-hardy&quot;

https://api.deezer.com/search?q=artist:&quot;mylène-farmer&quot;

https://api.deezer.com/search?q=artist:&quot;noir-désir&quot;

ERREURS SUR LES TABLEAUX ASSO, algo à revoir
```
https://api.deezer.com/search?q=artist:&quot;bee-gees&quot; album:&quot;stayin-alive&quot;

Warning: Invalid argument supplied for foreach() in /var/www/html/apo-Shabadabada/public/wp-content/plugins/shabadabada/class/Deezer.php on line 121

Notice: Array to string conversion in /var/www/html/apo-Shabadabada/public/wp-content/plugins/shabadabada/class/Deezer.php on line 82

Warning: file_get_contents(https://api.deezer.com/search?q=artist:&quot;bee-gees&quot; album:&quot;Array&quot;): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad request in /var/www/html/apo-Shabadabada/public/wp-content/plugins/shabadabada/class/Deezer.php on line 113

```


