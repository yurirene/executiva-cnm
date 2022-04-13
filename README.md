<p align="center"><a href="https://ump.org.br" target="_blank"><img src="https://ump.org.br/templates/yootheme/cache/logo_original-abfcb99f.webp"></a></p>

# SISVOTO
## Sistema de Votação para Sociedades Internas

Este projeto foi desenvolvido para atender ao modelo atual de Eleição da Confederação Nacional de Mocidade 

- Contempla os 10 Cargos da Diretoria
- Cadastro de candidatos escolhidos previamente.
- Definição de Regiões que podem votar.
- Área de Votação de Pautas.
- Delegados Importados por Planilha.

## Informações técnicas

- Linguagem: PHP 7.4 - Framework Laravel
- Banco de Dados: Mysql

## Instalação

- git clone https://github.com/yurirene/sisvoto-nacional.git
- execute o comando __composer install__
- criar arquivo __.env__ (utilze o arquivo __.env.example__ como modelo)
- edite as configurações do banco de dados
- execute o comando __php artisan key:generate__
- execute o comando __php artisan migrate --seed__
- execute o comando __php artisan storage:link__

## Utilização

### Painel Administrativo
- 'dominio.com'/admin
- Usuário: admin@admin.com
- Senha: admin@123

### Área de Votação (Eleição)
- 'dominio.com'/
- Código: código cadastrado em "Delegados"

### Área de Votação (Pautas)
- 'dominio.com'/pautas
- Código: código cadastrado em "Delegados"
