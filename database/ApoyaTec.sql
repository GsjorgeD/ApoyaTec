-- Database name: ApoyaTec
-- 29/04/2021 version:1.1
-- 06/05/2021
-- Equipo 1
CREATE DATABASE ApoyaTec;

USE ApoyaTec;

-- usuario especial creado especificamente para la BD
CREATE ROLE IF NOT EXISTS 'fenixfuego'@'localhost';
GRANT ALL ON apoyatec.* TO 'fenixfuego'@'localhost';


CREATE TABLE ads (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    title VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    picture VARCHAR(1024),
    url VARCHAR(1024) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT ads_id_pk PRIMARY KEY (id)
);
ALTER TABLE ads COMMENT 'Tabla para los anuncios del HOME';


CREATE TABLE roles (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT roles_id_pk PRIMARY KEY (id),
    CONSTRAINT roles_name_uk UNIQUE KEY (name)
);


CREATE TABLE maintags ( 
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
     `name` VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT maintags_name_uk UNIQUE KEY (name),
    CONSTRAINT maintags_name_pk PRIMARY KEY (id)
);
ALTER TABLE maintags COMMENT 'Tabla los tags principales';



CREATE TABLE tags (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(50) NOT NULL,
    mainTag_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT tags_name_uk UNIQUE KEY (name),
    CONSTRAINT tags_id_pk PRIMARY KEY (id),
    CONSTRAINT tags_maintag_fk FOREIGN KEY (mainTag_id)
	REFERENCES maintags (id) ON DELETE CASCADE
);
ALTER TABLE tags COMMENT 'Tabla para los tags especificos';


CREATE TABLE users (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    controlNumber VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    picture LONGBLOB,
    aboutYou VARCHAR(200),
    `password` VARCHAR(256) NOT NULL,
    rol_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT users_id_pk PRIMARY KEY (id),
    CONSTRAINT users_controlNumber_uk UNIQUE KEY (controlNumber),
    CONSTRAINT users_email_uk UNIQUE KEY (email),
    CONSTRAINT users_rol_fk FOREIGN KEY (rol_id)
        REFERENCES roles (id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

DELIMITER $$
CREATE PROCEDURE registro_Usuario ( nombre VARCHAR(100), lastname VARCHAR(100) , controlNumber VARCHAR(10) , email VARCHAR(100) , picture LONGBLOB, aboutYou VARCHAR(200), rol_id smallint)
BEGIN
	INSERT INTO users (`name` , lastname, controlNumber, email, picture, aboutYou, `password`, rol_id)  
    VALUES (nombre , lastname, controlNumber, email, picture, aboutYou, controlNumber, rol_id);
END$$

CREATE VIEW datos_Basicos AS
    SELECT 
        `name`, lastname, controlNumber, email, picture, aboutYou
    FROM
        users
    WHERE
        lastname = 'Corona';
    
CREATE TABLE courses
(
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    score DECIMAL(1,1) DEFAULT(0),
    `level` TINYINT(3) NOT NULL DEFAULT(1),
    `type` BIT NOT NULL DEFAULT(0),
    picture LONGBLOB,
    objective TEXT NOT NULL,
    knowledge VARCHAR(500) NOT NULL DEFAULT('Sin conocimientos previos necesarios'),
    target VARCHAR(100) NOT NULL,
    user_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    constraint courses_id_pk primary key(id),
    CONSTRAINT courses_name_uk UNIQUE KEY (name),
    CONSTRAINT courses_userid_fk FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE course_tag (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    course_id SMALLINT UNSIGNED NOT NULL,
    tag_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT course_tag_id_pk PRIMARY KEY (id),
    CONSTRAINT course_tag_course_id_fk FOREIGN KEY (course_id)
        REFERENCES courses (id)
        ON DELETE CASCADE,
    CONSTRAINT course_tag_tag_id_fk FOREIGN KEY (tag_id)
        REFERENCES tags (id)
        ON DELETE CASCADE
);
ALTER TABLE course_tag COMMENT 'Tabla para colocarle muchos tags a muchos cursos';


CREATE TABLE resources (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    urlResource VARCHAR(1024) NOT NULL,
    course_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT resourse_id_pk PRIMARY KEY (id),
    CONSTRAINT resorces_course_id_fk FOREIGN KEY (course_id)
        REFERENCES courses (id)
        ON DELETE CASCADE
);
ALTER TABLE resources COMMENT 'Tabla para los recursos de cada curso';

CREATE TABLE sections
(
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `index` TINYINT NOT NULL DEFAULT(1),
    course_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT sections_id_pk PRIMARY KEY(id),
    CONSTRAINT sections_course_id_fk FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
);
ALTER TABLE courses COMMENT 'Tabla para las secciones de un curso que contendran las clases';


CREATE TABLE classes
(
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    urlVideo VARCHAR(1024) NOT NULL,
    duration TIME NOT NULL,
    views INT NOT NULL DEFAULT(0),
    notes TEXT NOT NULL DEFAULT('Sin notas de curso'),
    _index TINYINT NOT NULL DEFAULT(1),
    section_id SMALLINT UNSIGNED NOT NULL,
    course_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT classes_id_pk PRIMARY KEY(id),
    CONSTRAINT classes_section_id_fk FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE,
    CONSTRAINT classes_course_id_fk FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);


CREATE TABLE questions (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    title VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    likes INT NOT NULL,
    dislikes INT NOT NULL,
    class_id SMALLINT UNSIGNED NOT NULL,
    user_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT questions_id_pk PRIMARY KEY (id),
    CONSTRAINT questions_class_id_fk FOREIGN KEY (class_id)
        REFERENCES classes (id)
        ON DELETE CASCADE,
    CONSTRAINT questions_user_id_fk FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE
);

CREATE TABLE answers
(
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    content TEXT NOT NULL,
    likes INT NOT NULL DEFAULT(0),
    dislikes INT NOT NULL DEFAULT(0),
    question_id SMALLINT UNSIGNED NOT NULL,
    user_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT answers_id_pk PRIMARY KEY(id),
    CONSTRAINT answers_question_id_fk FOREIGN KEY(question_id) REFERENCES questions(id) ON DELETE CASCADE,
    CONSTRAINT answers_user_id_fk FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
ALTER TABLE answers COMMENT 'Tabla para la respuesta de las preguntas de los usuario';

CREATE TABLE historical (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    user_id SMALLINT UNSIGNED NOT NULL,
    class_id SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT historical_id_pk PRIMARY KEY (id),
    CONSTRAINT historical_user_id_fk FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE,
    CONSTRAINT historical_class_id_fk FOREIGN KEY (class_id)
        REFERENCES classes (id)
        ON DELETE CASCADE
);
ALTER TABLE historical COMMENT 'Tabla que genera el historial de las clases, quien la vi y cuando';
ALTER TABLE historical 

-- 1
INSERT INTO roles (`name`) 
VALUES ("Tutor");
INSERT INTO roles (`name`) 
VALUES ("Alumno");
INSERT INTO roles (`name`) 
VALUES ("Administrador");

-- 2
INSERT INTO maintags (`name`)
VALUES ("Desarrollo de Software");
INSERT INTO maintags (`name`)
VALUES ("Hardware y electronicos");
INSERT INTO maintags (`name`)
VALUES ("Finanzas y Emprendimiento");
INSERT INTO maintags (`name`)
VALUES ("Desarrollo Personal");
-- La apliación solo está contemplada para estas categorías.

-- 3
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Desarrollo Web",1);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Desarrollo Móvil",1);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Desarrollo de Videojuegos",1);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Inteligencia Artificial",1);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Base de datos",1);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Electronica",2);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Arduino",2);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Marketing",3);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Idiomas",4);
INSERT INTO tags (`name`,mainTag_id)
VALUES ("Trabajo en equipo",4);



-- 4
Call registro_Usuario ("Roberto","Corona", "18TE0508", "coronarober@gmail.com","p.png","hola",1);
Call registro_Usuario ("Jonathan","Bello", "18TE0382", "Jonathan@gmail.com","p.png","hola",2);
Call registro_Usuario ("Ángel","Gasca", "18TE0155", "angel@gmail.com","p.png","hola",1);
Call registro_Usuario ("Martin","Miranda", "18TE0978", "martin@gmail.com","p.png","hola",2);
Call registro_Usuario ("Zuri","Peralta", "18TE0333", "zuri@gmail.com","p.png","hola",1);
Call registro_Usuario ("Carmen","Mendoza", "18TE0500", "carmen@gmail.com","p.png","hola",2);
Call registro_Usuario ("Elizabeth","Lucas", "18TE0501", "elizabeth@gmail.com","p.png","hola",1);
Call registro_Usuario ("Inez","González", "18TE0405", "inez@gmail.com","p.png","hola",2);
Call registro_Usuario ("Estefanía","Estrada", "18TE0804", "estefania@gmail.com","p.png","hola",1);
Call registro_Usuario ("Michelle","Vazquez", "18TE0313", "michelle@gmail.com","p.png","hola",2);

-- 5
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Desarrollo Móvil con Flutter","Flutter de 0 a experto",5,3,0,"flutter.png","Aprender Flutter","Android básico","Alumnos que quieran aprender desarrollo móvil",1);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("JavaScript","JavaScript para principiantes",2,1,0,"javascript.png","Aprender JavaScript","Sin conocimientos previos necesarios","Alumnos interesados en el desarrollo web",2);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Html","Iniciación HTML",0,1,0,"html.png","Aprender HTML","Sin conocimientos previos necesarios","Alumnos interesados en el desarrollo web",3);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Angular","Angular 11",2,3,0,"angular.png","Aprender Angular","JavaScript, html, css","Alumnos interesados en el desarrollo web",4);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("React","React JS",3,3,0,"react.png","Aprender React","JavaScipt, Hooks","Alumnos interesados en el desarrollo web",5);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Mi primer página web","Desarrollaras tus primera página web",0,1,0,"pagina.png","Aprender las bases de Html","Sin conocimientos previos necesarios","Alumnos interesados en el desarrollo web",6);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Administración de proyectos","Curso de administración y gestipon de empresas y organizaciones",0,1,0,"proyectos.png","Aprender a administrar proyectos","Sin conocimientos previos necesarios","Personas con el interes en trabajar en equipo",7);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("UX para principiantes","Diseña tus wireframes de manera profesional",2,1,0,"ux.png","Diseñar wireframes","Sin conocimientos previos necesarios","Alumnos interesados en el diseño",8);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Publicidad","Promociona tus productos de manera eficiente",0,1,0,"publicidad.png","Implementar publicdad eficiente","Sin conocimientos previos necesarios","Alumnos interesados en el marketing",9);
INSERT INTO courses (`name`,`description`,score,`level`,`type`,picture,objective,knowledge,target,user_id)
VALUES ("Aleman","Hablar aleman fluido",2,2,0,"aleman.png","Hablar de manera fluida aleman","Sin conocimientos previos necesarios","Alumnos interesados en aprender idiomas",10);



-- 6
INSERT INTO course_tag (course_id,tag_id)
VALUES (1,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (2,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (3,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (4,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (5,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (6,1);
INSERT INTO course_tag (course_id,tag_id)
VALUES (7,9);
INSERT INTO course_tag (course_id,tag_id)
VALUES (8,8);
INSERT INTO course_tag (course_id,tag_id)
VALUES (9,9);
INSERT INTO course_tag (course_id,tag_id)
VALUES (10,10);

-- 7
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,1);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,2);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,3);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,4);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,5);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,6);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,7);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,8);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,9);
INSERT INTO sections (`name`,`description`,`index`,course_id)
VALUES ("Unidad I","Inicio de labores",1,10);


-- 8
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=Xk-m2wPdY7Y",1);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=i9jqNlqJHIM",2);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=lR3bR8XwS8E",3);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=gd1avSicctw",4);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=W8HP6sZ40DY",5);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=mh9vUZBU13c",6);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=atgKzE_P1Kg",7);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=ATLiod7nHv8",8);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=AiaM4Vin4Uo",9);
INSERT INTO resources (`name`,urlResource,course_id)
VALUES ("Clase 1","https://www.youtube.com/watch?v=5A8E9RktpAo",10);

-- 9
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=Xk-m2wPdY7Y","00:30:10",10,"",1,1,1);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=i9jqNlqJHIM","00:30:10",10,"",1,2,2);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=lR3bR8XwS8E","00:30:10",10,"",1,3,3);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=gd1avSicctw","00:30:10",10,"",1,4,4);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=W8HP6sZ40DY","00:30:10",10,"",1,5,5);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=mh9vUZBU13c","00:30:10",10,"",1,6,6);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=atgKzE_P1Kg","00:30:10",10,"",1,7,7);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=ATLiod7nHv8","00:30:10",10,"",1,8,8);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=AiaM4Vin4Uo","00:30:10",10,"",1,9,9);
INSERT INTO classes (`name`,urlVideo, duration, views, notes, _index, section_id, course_id)
VALUES ("Diagnóstico","https://www.youtube.com/watch?v=5A8E9RktpAo","00:30:10",10,"",1,10,10);



-- 10
INSERT INTO historical (user_id,class_id)
VALUES (1,1);
INSERT INTO historical (user_id,class_id)
VALUES (2,2);
INSERT INTO historical (user_id,class_id)
VALUES (3,3);
INSERT INTO historical (user_id,class_id)
VALUES (4,4);
INSERT INTO historical (user_id,class_id)
VALUES (5,5);
INSERT INTO historical (user_id,class_id)
VALUES (6,6);
INSERT INTO historical (user_id,class_id)
VALUES (7,7);
INSERT INTO historical (user_id,class_id)
VALUES (8,8);
INSERT INTO historical (user_id,class_id)
VALUES (9,9);
INSERT INTO historical (user_id,class_id)
VALUES (10,10);


-- 11
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Desarrollo Móvil con Flutter","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=Xk-m2wPdY7Y");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("JavaScript","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=i9jqNlqJHIM");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Html","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=lR3bR8XwS8E");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Angular","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=gd1avSicctw");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("React","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=W8HP6sZ40DY");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Mi primer página web","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=mh9vUZBU13c");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Administración de proyectos","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=atgKzE_P1Kg");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("UX para principiantes","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=ATLiod7nHv8");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Publicidad","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=AiaM4Vin4Uo");
INSERT INTO ads (title, `description`, picture, url)
VALUES ("Aleman","Accede a la nueva materia diseñada para la comprención inicial de este gran curso","p.png","https://www.youtube.com/watch?v=5A8E9RktpAo");

-- 12
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,1,1);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,2,2);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,3,3);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,4,4);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,5,5);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,6,6);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,7,7);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,8,8);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,9,9);
INSERT INTO questions (title, content, likes, dislikes, class_id, user_id)
VALUES ("Qué tal te parece el curso", "Cuéntanos sobre cómo te parece la apertura del curso",10,0,10,10);

-- 13
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,1,1);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,2,2);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,3,3);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,4,4);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,5,5);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,6,6);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,7,7);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,8,8);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,9,9);
INSERT INTO answers (content, likes, dislikes, question_id, user_id)
VALUES ("Es interesante e interactivo",10,0,10,10);



DELETE FROM users
WHERE id = 10;

SELECT * FROM users;

UPDATE courses
SET `level` = 2
WHERE id = 2;

SELECT * FROM courses;

SELECT * FROM questions
JOIN answers ON questions.id = answers.question_id;


SELECT *
FROM users
INNER JOIN roles ON users.rol_id = 1;