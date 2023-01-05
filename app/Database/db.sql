drop database if exists  tienda;
create database tienda;
use tienda;

create table  cliente (
  Id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(50) NOT NULL,
  Apellidos VARCHAR(100) NOT NULL,
  Telefono VARCHAR(50) NOT NULL,
  Direccion VARCHAR(80) NOT NULL);

create table factura (
  Id INT(11) NOT NULL AUTO_INCREMENT,
  Fecha DATE NOT NULL,
  Descuento VARCHAR(50) NOT NULL,
  Cantidad VARCHAR(50) NOT NULL,
  cliente_Id INT(11) NOT NULL,
  PRIMARY KEY (Id, cliente_Id));

create table proveedores (
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(50) NOT NULL,
  Apellidos VARCHAR(100) NOT NULL,
  Telefono VARCHAR(5) NOT NULL);
  
create table producto (
  Id INT(11) NOT NULL AUTO_INCREMENT,
  Precio VARCHAR(50) NOT NULL,
  Descripcion VARCHAR(100) NOT NULL,
  Categoria VARCHAR(50) NOT NULL,
  proveedores_Id INT NOT NULL,
  PRIMARY KEY (Id, proveedores_Id));

create table venta (
  Id INT(11) NOT NULL AUTO_INCREMENT,
  Cantidad VARCHAR(50) NOT NULL,
  factura_Id INT(11) NOT NULL,
  factura_cliente_Id INT(11) NOT NULL,
  producto_Id INT(11) NOT NULL,
  PRIMARY KEY (Id, factura_Id, factura_cliente_Id, producto_Id));
  

  insert into  cliente values (null,'Marta','Garcia Perez','97142548','calle');
  insert into  cliente values (null,'Mario','Garcia Perez','97146788','calle');
  
   insert into  factura values (null,'22-10-2022','20%','123','1');
   insert into  factura values (null,'22-10-2022','11%','34','2');
   
  insert into  proveedores values (null,'Monica','Gomez Lopez','97142548');
  insert into  proveedores values (null,'Pedro','Gomez Lopez','97146788');
  
   insert into  producto values (null,'1,342','Color rojo','Papeleria','1');
   insert into  producto values (null,'2,482','cable','Electrico','2');