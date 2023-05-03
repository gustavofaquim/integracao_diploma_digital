# Integração Diploma Digital Externo

Atendendo a legislação vigente a UniEVANGÉLICA - Universidade Evangélica de Goiás emite a mais de um ano o diploma de graduação de seus estudantes em formato digital. Recentemente a universidade deu mais um passo é tem buscado parcerias com outras instituições de ensino. O sistema executa periodicamente rotinas que consomem as APIS do GED (Ábaris) e do sistema acadêmico (Lyceum), construindo uma ponte para que os dados possam trafegar entre as aplicações, reduzindo a necessidade de interação humana. A interface é simples e permite a visualização dos logs de retorno e o disparo manual das rotinas.


### 📋 Pré-requisitos

* Extensão do Curl do PHP habilitada<br>
    Windows: php.ini ;extension=php_curl.dll <br>
    Linux: sudo apt-get install php-curl <br>

* Drive de conexão do SQL Server <br>
    https://learn.microsoft.com/pt-br/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15 <br>
    Copiar os arquivos para o diretório ext <br>

* No arquivo php.ini, inseria a referência as DLLS <br>
    extension=php_pdo_sqlsrv_73_ts_x64.dll <br>
    extension=php_sqlsrv_73_ts_x64.dll <br>


## 🛠️ Construído com


* [PHP](https://www.php.net/manual/pt_BR/index.php) 
* [Javascript](https://www.javascript.com/) 


## ✒️ Autores

* **Gustavo Faquim** - *Desenvolvedor* - [gustavofaquim](https://github.com/gustavofaquim)