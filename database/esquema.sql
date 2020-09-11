CREATE DATABASE bdminimercado;
use bdminimercado;
CREATE TABLE `Persona` (
  `idPersona` INTEGER NOT NULL auto_increment,
  `nombre` VARCHAR(50) NOT NULL,
  `apellidoPaterno` VARCHAR(50) NOT NULL,
  `apellidoMaterno` VARCHAR(50) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `fecha_nac` DATE NOT NULL,
  `pais_nac` VARCHAR(50),
  `direccion` VARCHAR(100),
  `correo` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(50),
  `estado_civil` enum('S','C','D','V') NOT NULL,
  `nivel_educ` enum('E','B','U','G') NOT NULL,
  `profesion` VARCHAR(100),
  `foto` VARCHAR(150),
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A','I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idPersona`)
);

CREATE TABLE `UsuarioSistema` (
  `idUsuario` INTEGER NOT NULL,
  `alias` VARCHAR(50) NOT NULL,
  `user` BLOB NOT NULL,
  `password` BLOB NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A', 'I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idUsuario`)
);

CREATE TABLE `EmpleadoUsuario` (
  `idEmpleado` INTEGER NOT NULL,
  `idCargoFK` INTEGER NOT NULL,
  `ci` INTEGER NOT NULL,
  `user` BLOB NOT NULL,
  `password` BLOB NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A','I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idEmpleado`)
);

CREATE TABLE `Logeo` (
  `idLogeo` INTEGER NOT NULL auto_increment,
  `idUsuarioFK` INTEGER NOT NULL,
  `intentos` INTEGER NOT NULL,
  `fechaLogeo` DATE NOT NULL,
  `horaLogeo` TIME NOT NULL,
  `estado` enum('A','I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idLogeo`)
);

CREATE TABLE `Cargo` (
  `idCargo` INTEGER NOT NULL auto_increment,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(500),
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A','I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idCargo`)
);

CREATE TABLE `Marca` (
  `idMarca` INTEGER NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A', 'I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idMarca`)
);

CREATE TABLE `Producto` (
  `idProducto` INTEGER NOT NULL auto_increment,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(500),
  `foto` VARCHAR(150),
  `idSubCategoriaFK` INTEGER NOT NULL,
  `idMarcaFK` INTEGER NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A', 'I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idProducto`)
);

CREATE TABLE `SubCategoria` (
  `idSubCategoria` INTEGER NOT NULL auto_increment,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(500),
  `idCategoriaFK` INTEGER NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A', 'I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idSubCategoria`)
);

CREATE TABLE `Categoria` (
  `idCategoria` INTEGER NOT NULL auto_increment,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(500),
  `fecha_registro` DATE NOT NULL,
  `hora_registro` TIME NOT NULL,
  `estado` enum('A', 'I') NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idCategoria`)
);

ALTER TABLE `UsuarioSistema` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Persona`(`idPersona`);
ALTER TABLE `EmpleadoUsuario` ADD FOREIGN KEY (`idEmpleado`) REFERENCES `Persona`(`idPersona`);
ALTER TABLE `EmpleadoUsuario` ADD FOREIGN KEY (`idCargoFK`) REFERENCES `Cargo`(`idCargo`);
ALTER TABLE `Logeo` ADD FOREIGN KEY (`idUsuarioFK`) REFERENCES `Persona`(`idPersona`);
ALTER TABLE `Marca` ADD FOREIGN KEY (`idMarca`) REFERENCES `Persona`(`idPersona`);
ALTER TABLE `Producto` ADD FOREIGN KEY (`idMarcaFK`) REFERENCES `Marca`(`idMarca`);
ALTER TABLE `Producto` ADD FOREIGN KEY (`idSubCategoriaFK`) REFERENCES `SubCategoria`(`idSubCategoria`);
ALTER TABLE `SubCategoria` ADD FOREIGN KEY (`idCategoriaFK`) REFERENCES `Categoria`(`idCategoria`);









/*
INSERT INTO `persona` (`idPersona`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `genero`, `fecha_nac`, `pais_nac`, `direccion`, `correo`, `telefono`, `estado_civil`, `nivel_educ`, `profesion`, `foto`, `fecha_registro`, `hora_registro`, `estado`, `hash`) VALUES ('0', 'administrador', 'de', 'sistemas', 'M', '1990-10-15', 'bolivia', 'av. irala, calle blacutt #32', 'administrador2019@gmail.com', '87654321', 'C', 'G', 'administrador de sistemas', 'admindefault.svg', CURRENT_DATE(), CURRENT_TIME(), 'A', SHA1('1'));
insert into usuariosistema values(1,'administrador', AES_ENCRYPT('admin2020','minimarket2020'), AES_ENCRYPT('admin2020','minimarket2020'),CURRENT_DATE(),CURRENT_TIME(),'A',SHA1(1))
*/

/*  migraciones de datos   */


/*
INSERT INTO personas (idPersona, nombre, apellidoPaterno,apellidoMaterno,genero,fecha_nac,pais_nac,direccion,correo,telefono,estado_civil,nivel_educ,profesion,foto,fecha_registro,hora_registro,estado,hash)
SELECT * FROM bdminimarket.Persona;

INSERT INTO marcas (idMarca, nombre, fecha_registro, hora_registro, estado, hash)
SELECT * FROM bdminimarket.Marca;

INSERT INTO categorias (idCategoria, nombre, descripcion,fecha_registro,hora_registro,estado,hash)
SELECT * FROM bdminimarket.categoria;

INSERT INTO sub_categorias (idSubCategoria, nombre, descripcion,idCategoriaFK,fecha_registro,hora_registro,estado,hash)
SELECT * FROM bdminimarket.SubCategoria;
*/