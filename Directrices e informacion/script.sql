create database educacion default character set utf8 collate utf8_unicode_ci;

create user usereducacion@localhost identified by 'usereducacion';

grant all on educacion.* to usereducacion@localhost;

flush privileges;

use educacion;

create table profesor (
    email varchar(255) primary key,
    contrasenia varchar(255) not null,
    departamento ENUM('Música', 'Informática', 'Corte y confección'),
    foto varchar(255)
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

create table grupo (
    idGrupo int auto_increment primary key,
    nivel varchar (50) not null,
    titulacion varchar (50) not null,
    promocion varchar (9) not null
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

create table actividades (
    idActividades int auto_increment primary key,
    titulo varchar (50) not null unique,
    descripcion varchar (255) not null,
    fechaInicio datatime not null,
    fechaFin datatime not null,
    email varchar(255),
    idGrupo int,
    foto varchar (255)
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;
