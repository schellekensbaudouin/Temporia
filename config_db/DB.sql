-- 1. Table CATEGORY
CREATE TABLE CATEGORY (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE
);

-- 2. Table USER (Mise à jour selon tes colonnes)
CREATE TABLE USER (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(150) NOT NULL UNIQUE,
    hash_pwd VARCHAR(255) NOT NULL,
    user_name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    profile_picture TEXT,
    roles VARCHAR(50) DEFAULT 'acheteur', -- Stocké en string (ex: "acheteur", "vendeur" ou "admin")
    bio TEXT,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. Table ARTICLE
CREATE TABLE ARTICLE (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL, -- Liaison avec ta table USER
    category_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price INT NOT NULL,
    currency ENUM('$','€'),
    statut ENUM('actif', 'vendu', 'archive', 'ban') DEFAULT 'actif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES CATEGORY(id) ON DELETE RESTRICT
);

-- 4. Table PHOTO_ARTICLE
CREATE TABLE PHOTO_ARTICLE (
    id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT NOT NULL,
    url_photo TEXT NOT NULL,
    est_principale BOOLEAN DEFAULT FALSE,
    
    FOREIGN KEY (article_id) REFERENCES ARTICLE(id) ON DELETE CASCADE
);

CREATE TABLE MESSAGE (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    article_id INT NOT NULL,
    contenu TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    
    FOREIGN KEY (user_id) REFERENCES USER(id) ON DELETE SET NULL, 
    FOREIGN KEY (article_id) REFERENCES ARTICLE(id) ON DELETE CASCADE
);

CREATE TABLE PROFIL_VENDEUR (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,  -- lien avec USER

    -- Infos privées (Vendeur)
    first_name VARCHAR(100) NOT NULL,  -- Prénom du vendeur 
    last_name VARCHAR(100) NOT NULL,  -- Nom du vendeur
    birth_date DATE NOT NULL,  -- Date de naissance
    national_id VARCHAR(50) NOT NULL, -- Numéro d'identité national
    phone VARCHAR(20) NOT NULL,    -- Numéro de téléphone du vendeur
    address TEXT NOT NULL,         -- Adresse complète
    country VARCHAR(100) NOT NULL, -- Pays
    id_front_url TEXT NOT NULL,   -- Photo de la carte d identité recto (privé)
    id_back_url TEXT NOT NULL,    -- Photo de la carte d identité verso (privé)

    -- Infos publiques du Vendeur visibles sur la marketplace
    shop_name VARCHAR(150) NOT NULL,   -- nom affiché publiquement
    shop_description TEXT,             -- description boutique
    shop_logo_url TEXT,                -- logo boutique

    verified_status ENUM('pending','approved','rejected') DEFAULT 'pending',  -- Validation Approuvé ou rejeter
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES USER(id) ON DELETE CASCADE
);