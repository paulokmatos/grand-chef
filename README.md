# Grand Chef API

## Requisitos
```sh
Docker version 27.3.1 
Docker Compose version v2.29.7
```

## Setup do Projeto
```
cp .env.example .env
docker compose up -d
docker exec -it grandchef_api chmod -R 777 ./storage
docker exec -it grandchef_api composer install
docker exec -it grandchef_api php artisan migrate --seed
```

## Sobre o Projeto
- Testes unitários com PHPUnit.
- Testes de Mutação com Infection.
- Lint com Larastan e Pint.
- CI/CD com Github actions.
- Documentação com Swagger (OpenApi 3.0).
- Logs com Kibana/Elasticsearch.

## Design Patterns
- Foi utilizado o padrão Action para garantir o SRP e encapsular funções de maior complexidade.
- Foi utilizado o padrão Strategy no `OrderStatusValidator` para garantir a validação dos Status do Pedido.

## Documentação
Gerar documentação
```sh
docker exec -it grandchef_api php artisan l5-swagger:generate
```
Após gerar a documentação poderá ser acessada através [desse link](http://172.175.10.1/api/documentation)

## Logs

- O projeto utiliza o Kibana como client do ElasticSearch para gerenciamento de Logs do sistema.
- Foi criado o `RequestLogMiddleware` para registrar os logs de todas as requisições feitas na API.
- Você pode acessar os logs através [desse link](http://localhost:5601/app/kibana#/discover)

![image](https://github.com/user-attachments/assets/67d32413-87e4-4324-bf7d-11e6820d9cbe)

## Configurando Kibana
### Registrar índex pattern

Ao acessar pela primeira vez a URL acima você será redirecionado para esta [página](http://localhost:5601/app/kibana#/management/kibana/index_patterns): <br>
![image](https://github.com/user-attachments/assets/eafe0d57-1af1-4743-843a-ad5e21808d43)

Então é preciso fazer um primeira requisição para ter dados para gerar um index pattern. <br>

Após a primeira requisição essa tela irá ficar dessa forma e preencha conforme a imagem abaixo: 

![image](https://github.com/user-attachments/assets/9366e09a-7c3a-4cc1-a33e-81d2380e1271)

Então selecione a opção datetime: 
![image](https://github.com/user-attachments/assets/20f7fcad-95b5-4893-8915-9b3a36d35208)

Após isso você poderá ter acesso aos logs [nesse link](http://localhost:5601/app/kibana#/discover) 

