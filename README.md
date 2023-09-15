# Sistema de Controle de Reservas - SCR Reservas

Sistema que permite o gerenciamento de reservas para hotéis, pousadas, resorts, hostel, flat...

## Iniciando

- Copie o projeto para sua máquina: clone https://github.com/randercarlos/scr-reservas.git ou baixe o projeto compactado
  em formato zip e o extraia para uma pasta.
- Composer deve estar instalado e configurado nas variáveis de ambiente
- PHP Versão >= 5.6 deve estar instalado e o configurado nas variáveis de ambiente

### Pré-requisitos

* Interpretador PHP Versão >= 5.6
* Composer Dependency Manager(Última versão)
* Symfony full-stack PHP Framework(Versão 3.6)
* Doctrine Migrations Bundle(Versão 1.2.1)
* Doctrine Fixtures Bundle(Versão 2.3)
* MySQL(Versão 5.7)
* Apache 2.4 Web Server ou PHP's Web Server Built-in

### Instalando

* Após ter o projeto clonado do github ou baixado e extraído, entre na pasta do projeto através da linha de comando e
  instale as dependências através do comando: composer install.

* Configure os parâmetros de conexão ao banco de dados em pasta-do-projeto/app/config/config.yml

* Feito isso, crie o banco de dados na linha de comando através do comando: php bin/console doctrine:database:create
  O banco de dados será criado

* Após criar o banco de dados, crie as tabelas através da linha de comando com o comando:
  php bin/console doctrine:schema:create

* Na pasta do projeto na linha de comando, inicie o servidor embutido do PHP através do comando:
  php bin/console server:run

* Acesse o projeto em http://localhost:8000(ou com outra porta, se a porta 8000 estiver em uso)

End with an example of getting some data out of the system or using it for a little demo

## Versão

Versão 1.0-Beta

## Autor

**Rander Carlos** - *Trabalho Inicial* - (https://github.com/randercarlos)

## Licença

Esse projeto está licenciado pela licença MIT - Ver o arquivo [LICENSE.md](LICENSE.md) para mais detalhes