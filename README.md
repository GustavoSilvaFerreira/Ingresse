### Configuração
# clonar o projeto do git e colocar na pasta raiz do servidor
git clone https://github.com/GustavoSilvaFerreira/Ingresse.git


### Mysql
# Alterar configurações do banco em:
src/model/Connect.php

# Script
CREATE DATABASE Teste;

USE Teste;

CREATE TABLE Usuarios (cd_Usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                     nm_Usuario VARCHAR (50) NOT NULL,
                     ds_Email VARCHAR (50) NOT NULL);


### Executar o projeto
# Dentro do diretorio do projeto
php composer.phar start


### Rodar teste unitario:
# Dentro do diretorio do projeto
./vendor/bin/phpunit OU php composer.phar test


### Curl
# Listar todos os usuarios:
curl -v -X GET https://aulaphp-gustavoferreira.c9users.io/ingresse/testeIngresse/public/index.php/usuario -H 'Content-Type:application/json'

# Listar um usuario pelo id(mudar o id na rota por um válido):
curl -v -X GET https://aulaphp-gustavoferreira.c9users.io/ingresse/testeIngresse/public/index.php/usuario/1 -H 'Content-Type:application/json'

# Inserir Usuario:
curl -v -X POST https://aulaphp-gustavoferreira.c9users.io/ingresse/testeIngresse/public/index.php/usuario -H 'Content-Type:application/json' \
-d '{"nome":"teste2","email":"teste2@hotmail.com"}'

# Alterar usuario(mudar o id na rota por um válido):
curl -v -X PUT https://aulaphp-gustavoferreira.c9users.io/ingresse/testeIngresse/public/index.php/usuario/2 -H 'Content-Type:application/json' \
-d '{"nome":"testeAlterar","email":"alterado2@hotmail.com"}'

# Deletar usuario(mudar o id na rota por um válido):
curl -v -X DELETE https://aulaphp-gustavoferreira.c9users.io/ingresse/testeIngresse/public/index.php/usuario/20 -H 'Content-Type:application/json'