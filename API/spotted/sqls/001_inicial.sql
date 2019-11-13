CREATE DATABASE spotted COLLATE 'utf8_unicode_ci';

create table if not exists usuarios
(
    id_usuario int auto_increment,
    nome       varchar(50)  not null,
    sobrenome  varchar(150) not null,
    email      varchar(200) not null,
    senha      varchar(65)  not null,
    primary key (id_usuario)
) ENGINE = InnoDB;


CREATE table if not exists questoes
(
    id_questao             int auto_increment,
    id_usuario           int           not null,
    titulo               varchar(255)  NOT NULL,
    descricao            varchar(1000) not null,
    dificuldade          varchar(25)   not null,
    alternativa_correta   varchar(255)  not null,
    data_criacao          TIMESTAMP     not null,
    quantidade_acerto int           not null,
    quantidade_erro    int           not null,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    PRIMARY KEY (id_questao)
) ENGINE = InnoDB;


CREATE TABLE if not exists alternativas
(
    id_alternativa int auto_increment,
    id_questao       int          not null,
    alternativa    varchar(255) NOT NULL,
    FOREIGN KEY (id_questao) REFERENCES questoes (id_questao),
    PRIMARY KEY (id_alternativa)
) ENGINE = InnoDB;



CREATE TABLE if not exists respostas
(
    id_resposta int auto_increment,
    id_usuario   int          not null,
    id_questao     int          not null,
    data_resposta TIMESTAMP    not null,
    acertou      boolean      not null,
    alternativa  varchar(255) not null,
    FOREIGN KEY (id_questao) REFERENCES questoes (id_questao),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    PRIMARY KEY (id_resposta)
) ENGINE = InnoDB;
