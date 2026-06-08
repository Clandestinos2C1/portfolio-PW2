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
'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f'
),

(
'Back in Black',
'AC/DC',
119.90,
1,
'Clássico absoluto do hard rock.',
0,
10,
'https://images.unsplash.com/photo-1511379938547-c1f69419868d'
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
'https://images.unsplash.com/photo-1516280440614-37939bbacd81'
),

(
'GUTS',
'Olivia Rodrigo',
109.90,
2,
'Sucesso mundial com hits e letras marcantes.',
1,
18,
'https://images.unsplash.com/photo-1501612780327-45045538702b'
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
'https://images.unsplash.com/photo-1487180144351-b8472da7d491'
),

(
'Construção',
'Chico Buarque',
84.90,
3,
'Álbum histórico da MPB.',
0,
8,
'https://images.unsplash.com/photo-1510915361894-db8b60106cb1'
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
'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae'
),

(
'Currents',
'Tame Impala',
119.90,
4,
'Psicodelia moderna com produção impecável.',
1,
11,
'https://images.unsplash.com/photo-1507838153414-b4b713384a76'
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
'https://images.unsplash.com/photo-1465847899084-d164df4dedc6'
),

(
'Symphony No. 5',
'Ludwig van Beethoven',
79.90,
5,
'Obra-prima da música erudita.',
1,
7,
'https://images.unsplash.com/photo-1507838153414-b4b713384a76'
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
'https://images.unsplash.com/photo-1501386761578-eac5c94b800a'
),

(
'BORN PINK',
'BLACKPINK',
129.90,
6,
'Grande sucesso do quarteto sul-coreano.',
1,
22,
'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f'
);