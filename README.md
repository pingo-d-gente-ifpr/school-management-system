<p align="center" width="400">

<img src="https://i.imgur.com/gSyTvA3.png" alt="Logo Pingo D' Gente" width="500">
    
</p>

# 🍉 Sistema de Gerenciamento Escolar: Pingo d' Gente


[![Requisitos](https://img.shields.io/badge/Requisitos-99D98F?style=for-the-badge)](https://docs.google.com/document/d/1dPLNbWGPJrLT6XW6vUQCduGXSOD5udjA/edit?usp=sharing&ouid=110106372221435632533&rtpof=true&sd=true)
[![Diagrama de Caso de Uso](https://img.shields.io/badge/Casos%20de%20Uso-F26B8F?style=for-the-badge)](https://drive.google.com/file/d/1rXeYg-VK0TMsUCLDTi41SwxnXuDuftzV/view)
[![Diagrama de Entidade-Relacionamento](https://img.shields.io/badge/Diagrama%20Entidade%20Relacionamento-81DEE3?style=for-the-badge)](https://miro.com/welcomeonboard/VWFiczJkdFZFZDNuWnMyZ0JGYVowYzJZM3k0cTY5YWcydWprT2FhY0dJeWNWNjQ1YXV4ZG8wWnBBbnhOZ09TcnwzNDU4NzY0NTI4ODIwMjA1NzE2fDI=?share_link_id=929135724874)
[![Diagrama de Caso de Uso](https://img.shields.io/badge/Prot%C3%B3tipos-F26B8F?style=for-the-badge)](https://www.figma.com/proto/2istVcaliudTGEq6s4SSaB/Untitled?type=design&node-id=45-6&t=IG7H2hlbh8CqxTU4-1&scaling=scale-down&page-id=0%3A1&starting-point-node-id=2%3A3&mode=design)

Todo mundo sabe que os primeiros anos de escola podem ser problemáticos tanto para os alunos, como para os pais e professores. É um momento onde é necessário criar confiança e ter uma comunicação clara entre os responsáveis. Por isso, o Sistema Pingo d' Gente foi criado, para que neste momento, pais possam acompanhar o andamento dos filhos na creche, além de facilitar o gerenciamento de turma e frequência para professores. Criando, assim, um ecossistema integrado, colaborativo e especial para todos.

O Pingo d' Gente é um sistema web desenvolvido para facilitar o gerenciamento de uma creche, oferecendo uma plataforma abrangente e intuitiva para administradores, professores, pais e alunos. Com uma variedade de recursos voltados para a comunicação, organização e monitoramento, o sistema visa otimizar o fluxo de informações e promover uma experiência escolar mais eficiente e transparente.

## Construído com
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
<br><br>
O Pingo d' Gente foi construído utilizando as seguintes ferramentas e tecnologias:
* [PHP](http://www.php.net) - Linguagem de programação utilizada para a lógica do sistema
* [Laravel](http://www.dropwizard.io/1.0.2/docs/) - Framework web que oferece estrutura sólida para o desenvolvimento ágil e seguro
* [Composer](https://maven.apache.org/) -  Gerenciador de dependências para a integração de bibliotecas e pacotes no projeto

## Escopo do Projeto

| **Funcionalidade**                     | **Descrição**                                                                                                                                      |
|-----------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------|
| **Gerenciamento de Usuários**           | Cadastro, edição e exclusão de informações de usuários, incluindo administradores, professores e responsáveis.                                      |
| **Gerenciamento de Eventos**            | Criação, edição e exclusão de eventos escolares, permitindo o acompanhamento de atividades por parte dos responsáveis.                             |
| **Gerenciamento de Alunos**             | Cadastro, edição e acompanhamento das informações dos alunos, com foco na matrícula e no monitoramento de seu desempenho escolar.                  |
| **Gerenciamento de Matérias e Turmas**  | Organização das matérias e turmas, incluindo horários, professores responsáveis e alunos matriculados.                                             |
| **Registro de Notas e Frequências**     | Permitir que os professores registrem e editem as notas e frequências dos alunos, permitindo que os responsáveis acompanhem essas informações.      |

## Pré-requisitos

Antes de iniciar a instalação, certifique-se de ter os seguintes requisitos atendidos:

- **Docker**: Para a configuração e execução dos containers.

## Instalação do Projeto

Siga os passos abaixo para configurar e executar o projeto localmente.

1. **Clone o repositório** na sua máquina:

    ```bash
    git clone git@github.com:pingo-d-gente-ifpr/school-management-system.git
    ```

2. **Crie o arquivo `.env`** na raiz do projeto, baseado no arquivo `.env.example`:

    ```bash
    cp .env.example .env
    ```

3. **Suba os containers Docker** com o `docker-compose`:

    ```bash
    docker-compose up --build -d
    ```

4. **Acesse o container do workspace**:

    ```bash
    docker-compose exec workspace bash
    ```

5. **Instale as dependências do PHP** usando o Composer:

    ```bash
    composer install
    ```

6. **Instale o Vite:

    ```bash
    npm install vite
    ```

7. **Compile os assets do front-end** com o Vite:

    ```bash
    npm run build
    ```

8. **Gere a chave da aplicação**:

    ```bash
    php artisan key:generate
    ```

9. **Execute as migrations** para configurar o banco de dados:

    ```bash
    php artisan migrate
    ```

10. **(Opcional) Popule o banco de dados com dados fictícios** rodando os seeders:

    ```bash
    php artisan db:seed
    ```

Após seguir esses passos, seu projeto estará configurado e pronto para ser utilizado!

## Autores

* **Allan Gabriel de Freitas Pedros** - *Desenvolvedor Fullstack* - [Allan Gabriel](https://github.com/agp531)
* **Nicole Paz Bueno de Oliveira** - *Desenvolvedora e Gestora de Projetos* - [Nicole Paz](https://github.com/nicpaz)

## Licença

O framework Laravel é um software de código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT), permitindo a utilização, modificação e distribuição do código fonte de forma livre e gratuita.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"></a></p>

