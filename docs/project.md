## Build les asset pour le front

**Se placer dans le dossier racineDuProjet/front**
// DOC https://parceljs.org/cli.html
```sh
parcel watch --public-url . --out-dir ../public/front index.html
```
Attention cette commande crée une version de "développement" (websocket mes-coui...) ; mais il faut faire ceci pour que parcel installe les dépendances nécessaires


**Création d'une version de production**
```sh
parcel build --public-url .  --no-minify --out-dir ../public/front index.html
```

**Afficher les BDD en ldc**
```sh
sudo mysql -e "show databases"
```


**Supprimer une BDD en ldc**
```sh
sudo mysql -e "drop database NomDeLaDatabase"
```

**Afficher le contenu d'un fichier en ldc**
```sh
cat cheminVersLeFichier

ex: cat docs/Shabadabada.sql
```

**Importer une BDD (sauvegardée dans un fichier) dans Adminer en ldc**
1.la commande pour afficher le contenu du fichier
2.la commande pour l'insérer
on branche les 2 commandes entre elle avec un pipe " | "

```sh
cat docs/Shabadabada.sql | sudo mysql Shabadabada
```

**relance programme**
ps -aelf | grep "laCommandeAChercher"

kill -9 numéroDuProcessus