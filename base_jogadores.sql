
CREATE TABLE jogos ( 
    id int AUTO_INCREMENT NOT NULL, 
    nome varchar(70) NOT NULL,
    genero varchar(50) NOT NULL,
    CONSTRAINT pk_jogos PRIMARY KEY (id) 
);

INSERT INTO jogos (nome, genero) VALUES ('The last of us', 'terror');
INSERT INTO jogos (nome, genero) VALUES ('Genshin Impact', 'RPG');
INSERT INTO jogos (nome, genero) VALUES ('The Sims', 'Simulação');
INSERT INTO jogos (nome, genero) VALUES ('Valorant', 'FPS');


CREATE TABLE jogadores (
    id int AUTO_INCREMENT NOT NULL, 
    nomejogador varchar(70) NOT NULL, 
    idade int NOT NULL,
    plataforma varchar(50) NOT NULL,
    contextra varchar(1) NOT NULL,
    id_jogo int NOT NULL, 
    CONSTRAINT pk_jogadores PRIMARY KEY (id)
);
ALTER TABLE jogadores ADD CONSTRAINT fk_jogo FOREIGN KEY (id_jogo) REFERENCES jogos (id);


INSERT INTO jogadores (nomejogador, idade, plataforma, contextra, id_jogo) VALUES ('papricadoce', 18, 'PC', 'N', 2);
INSERT INTO jogadores (nomejogador, idade, plataforma, contextra, id_jogo) VALUES ('mrhilgenberg', 19, 'PS4', 'S', 3);
