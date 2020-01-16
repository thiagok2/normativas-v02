<h1>Normativas-app</h1>

# Arquitetura
1. PHP >= 7.1
2. Postgresql >=10
3. Elasticsearch >=6.4


# Elasticsearch
1. Instalar Ingest Attachment Plugin(https://www.elastic.co/guide/en/elasticsearch/plugins/6.8/ingest-attachment.html)
2. Criar índice e dos documentos no elasticsearch(POSTMAN collection)

# App
0. sudo apt install php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear

1. Permissões nas pastas /storage/app/public e /storage/logs
2. Executar o comando 
php artisan storage:link

# Configurações do env
APP_URL=?
ETL_DIR=?/normativas-crawlers-etl/etl/ 
ELASTIC_URL=
ELASTIC_INDEX=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
DATABASE_URL=


# Configuração do docker
Para subir o ambiente utilizando docker deve-se seguir os seguintes passos:

1. Instalar docker => https://docs.docker.com/install/linux/docker-ce/ubuntu/
2. Instalar docker-compose => https://docs.docker.com/compose/install/
3. Copiar o arquivo .env.example para .env e setar as propriedades de acordo (obs.:se a variável SEED_DATABASES for setada para 1 OU 2 então o banco será apagado e recriado). Caso a variável seja setada com o valor 2 então será realizado o download de um dump da base. 
4. Executar o comando './start-application.sh'. Caso queira que a aplicação seja executada em segundo plano basta passar a opção -d
5. Executar docker-compose up
