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

(
'The Dark Side of the Room',
'Echo Chambers',
89.90,
4,
'Álbum indie atmosférico e melancólico.',
0,
12,
'darkside.jpg'
),

(
'Neon Hearts',
'Luna Waves',
119.90,
2,
'Pop moderno com sintetizadores vibrantes e refrões marcantes.',
0,
8,
'neonhearts.jpg'
),

(
'Noites de Bossa',
'Clara Mendes',
97.50,
3,
'Uma homenagem moderna à bossa nova.',
1,
15,
'bossa.jpg'
),

(
'Seoul Dreams',
'NovaPulse',
129.90,
6,
'K-pop energético com influências eletrônicas e visuais futuristas.',
0,
20,
'seouldreams.jpg'
),

(
'Chuva de Flores',
'Orquestra Paulista',
135.00,
5,
'Coleção instrumental clássica brasileira.',
0,
5,
'chuva.jpg'
),

(
'Radio Nowhere',
'The Static Fields',
88.00,
1,
'Rock alternativo energético e nostálgico.',
0,
10,
'radionowhere.jpg'
);