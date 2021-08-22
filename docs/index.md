# Instruções do projeto:

## Configuração

Os dados de configurações serão carregados do arquivo [config.php](../config.php) no diretório root do projeto, copie [config-example.php](../config-example.php) e renomeie.

### Banco de dados

O projeto busca o arquivo com o mesmo nome da constante DATABASE em '/app/databases', o arquivo e a classe deve ter o mesmo nome. Implemente a função 'query' de modo que retorne um array quando feito um select ou o números de linhas afetadas quando um insert, update ou delete.

As configurações do banco deverão ser feitas no arquivo config.php nas constantes: DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME.

Arquivo sql com um exemplo do banco em [sql-example](./examples/sql-example.sql)

### JWT

O hash para definição do json web token deve ser definido no arquivo config.php na constante JWT_KEY.

## Endpoints

Os endpoints estão no diretório '/public/*', supondo que o projeto se encontra no endereço http://localhost/api-acp/ segue uma lista com  exemplod de requisições:

- login em http://localhost/api-acp/public/login/
- GET em http://localhost/api-acp/public/school/
- POST em http://localhost/api-acp/public/school/
- Para PUT: faça POST em http://localhost/api-acp/public/school/ com um parametro '_method' com valor PUT
- Para DELETE: faça POST em http://localhost/api-acp/public/school/ com um parametro '_method' com valor DELETE

Um arquivo com os exemplos de requisições completo para uso no postman pode ser baixado em [postman-example](./examples/postman-example). Após baixar o arquivo, abra o postman e vá para 'file>import' e faça o upload do arquivo.