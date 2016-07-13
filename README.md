# Projeto teste utilizando Doctrine

## Instalando composer

    php -r "readfile('https://getcomposer.org/installer');" | php

## Instalando dependências

    ./composer.phar install

## Criando base de dados

    psql -h 10.0.0.3 postgres postgres
     
    CREATE USER everton;
    CREATE DATABASE doctrine_everton OWNER everton;
     
    \c doctrine_everton everton
     
    CREATE TABLE teste (cd_teste SERIAL PRIMARY KEY, nm_teste TEXT NOT NULL);
    CREATE TABLE grupo (cd_grupo SERIAL PRIMARY KEY, nm_grupo TEXT NOT NULL);
    CREATE TABLE grupo_teste (cd_grupo INTEGER NOT NULL, cd_teste INTEGER NOT NULL);
    ALTER TABLE grupo_teste ADD CONSTRAINT pk_grupo_teste PRIMARY KEY (cd_grupo, cd_teste);
    ALTER TABLE grupo_teste ADD CONSTRAINT fk_grupo FOREIGN KEY (cd_grupo) REFERENCES grupo(cd_grupo);
    ALTER TABLE grupo_teste ADD CONSTRAINT fk_teste FOREIGN KEY (cd_teste) REFERENCES teste(cd_teste);
    
## Criando models com doctrine

    vendor/bin/doctrine orm:convert-mapping --force --from-database --namespace="Projeto\\BD\\" annotation src
    ./composer.phar dumpautoload -o
