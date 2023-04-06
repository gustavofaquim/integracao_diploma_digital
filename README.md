# integracao_diploma_digital

-> Necessário extensão do curl habilitada <br>
    -> Windows:  php.ini ;extension=php_curl.dll <br>
    -> Linux: sudo apt-get install php-curl <br>

-> Necessário instalar drive de conexão com o SQL Server <br>
    -> https://learn.microsoft.com/pt-br/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15 <br>
    -> Copiar os arquivos para o diretório ext <br>

-> Edite o arquivo php.ini, inserindo as extensões de acordo com nome das DLLs <br>
    -> extension=php_pdo_sqlsrv_73_ts_x64.dll <br>
    -> extension=php_sqlsrv_73_ts_x64.dll <br>