CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    quantidade_discos INT DEFAULT 0
);

CREATE TABLE discos (
    id_disco INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    artista VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria_id INT,
    descricao TEXT,
    destaque BOOLEAN DEFAULT FALSE,
    estoque INT DEFAULT 0,
    imagem VARCHAR(255),

    FOREIGN KEY (categoria_id)
    REFERENCES categorias(id_categoria)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'cliente') NOT NULL DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@tmaqd.com', '$2b$12$YYWltjSe3zJBU4VEa6xAAui/4lJPGNhqfBW7XjjXpiHCmycANuZuy', 'admin'),
('Cliente Demo', 'cliente@tmaqd.com', '$2b$12$dHwmeANOKXCb3BUUGWmGu.1dqx0PC4PfismrUkiGe6ZzjSPB1TBMK', 'cliente');

CREATE TABLE newsletter (
    id_email INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categorias (nome, descricao, quantidade_discos) VALUES
('Rock', 'Clássicos e novos riffs que marcam épocas', 340),
('Pop', 'Hits marcantes que dominam gerações', 260),
('MPB', 'A alma brasileira em cada compasso', 280),
('Indie', 'Sons independentes que viram movimento', 195),
('Clássicos', 'Obras eternas da música', 160),
('K-pop', 'Batidas intensas, performance e cultura coreana', 230);

INSERT INTO discos
(titulo, artista, preco, categoria_id, descricao, destaque, estoque, imagem)
VALUES


-- ROCK (1)
(
'The Dark Side of the Moon',
'Pink Floyd',
129.90,
1,
'Um dos álbuns mais influentes da história do rock.',
1,
15,
'https://upload.wikimedia.org/wikipedia/pt/thumb/3/3b/Dark_Side_of_the_Moon.png/250px-Dark_Side_of_the_Moon.png'
),

(
'Back in Black',
'AC/DC',
119.90,
1,
'Clássico absoluto do hard rock.',
0,
10,
'https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/ACDC_Back_in_Black.png/250px-ACDC_Back_in_Black.png'
),

-- POP (2)
(
'SOUR',
'Olivia Rodrigo',
99.90,
2,
'Álbum de estreia que conquistou milhões de fãs.',
1,
20,
'https://upload.wikimedia.org/wikipedia/pt/7/71/Sour_-_Olivia_Rodrigo.png'
),

(
'GUTS',
'Olivia Rodrigo',
109.90,
2,
'Sucesso mundial com hits e letras marcantes.',
1,
18,
'https://upload.wikimedia.org/wikipedia/pt/0/03/Olivia_Rodrigo_-_Guts.png'
),

-- MPB (3)
(
'Clube da Esquina',
'Milton Nascimento & Lô Borges',
89.90,
3,
'Uma das maiores obras da música brasileira.',
1,
12,
'https://upload.wikimedia.org/wikipedia/pt/c/cb/Milton_Nascimento_-_Clube_da_Esquina.jpg'
),

(
'Construção',
'Chico Buarque',
84.90,
3,
'Álbum histórico da MPB.',
0,
8,
'https://upload.wikimedia.org/wikipedia/pt/7/75/Constru%C3%A7%C3%A3o_chico_buarque.jpg'
),

-- INDIE (4)
(
'AM',
'Arctic Monkeys',
114.90,
4,
'Referência moderna do indie rock.',
1,
16,
'https://upload.wikimedia.org/wikipedia/pt/9/96/Capa-AM_%28oficial%29.jpeg'
),

(
'Currents',
'Tame Impala',
119.90,
4,
'Psicodelia moderna com produção impecável.',
1,
11,
'https://upload.wikimedia.org/wikipedia/pt/2/2d/Currents_Tame_Impala.png'
),

-- CLÁSSICOS (5)
(
'The Four Seasons',
'Antonio Vivaldi',
74.90,
5,
'Uma das composições mais famosas da música clássica.',
0,
9,
'https://upload.wikimedia.org/wikipedia/commons/1/1b/Antonio_Vivaldi.jpg'
),

(
'Symphony No. 5',
'Ludwig van Beethoven',
79.90,
5,
'Obra-prima da música erudita.',
1,
7,
'https://upload.wikimedia.org/wikipedia/commons/6/6f/Beethoven.jpg'
),

-- K-POP (6)
(
'MAP OF THE SOUL: 7',
'BTS',
134.90,
6,
'Um dos álbuns mais vendidos do grupo.',
1,
25,
'https://upload.wikimedia.org/wikipedia/pt/2/21/BTS_-_Map_of_the_Soul_7.png'
),

(
'BORN PINK',
'BLACKPINK',
129.90,
6,
'Grande sucesso do quarteto sul-coreano.',
1,
22,
'https://upload.wikimedia.org/wikipedia/pt/a/a1/Blackpink_-_Born_Pink.png'
);