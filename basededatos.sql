create table Usurio(
    id int(10) NOT NULL AUTO_INCREMENT,
    tipo_documento varchar(10) not null,
    documento int(15) not null unique,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    email varchar(50) not null unique,
    password varchar(50)not null,
    primary key (id)
    
);


create table Medidas(
     id int(10) NOT NULL AUTO_INCREMENT,
     pc_pierna  decimal not null,
     pc_axilar decimal not null,
     usuario_id int
     primary key (id),
     foreign key (usuario_id) references Usurio (id)

);
