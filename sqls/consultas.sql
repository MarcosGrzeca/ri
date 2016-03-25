-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Mar-2016 às 04:15
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ri`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(10) NOT NULL,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`id`, `num`, `title`, `desc`) VALUES
(1, 'C141', 'Carta-bomba para Kiesbauer', 'Encontrar información sobre la explosión de una carta-bomba en el estudio de la presentadora del canal de televisión PRO7 Arabella Kiesbauer.'),
(2, 'C142', 'Christo envuelve el edificio del Reichstag alemán', 'Encontrar documentos que hablen de este acto del artista alemán Christo en el Reichstag alemán en Berlín.'),
(3, 'C143', 'Conferencia de la Mujer en Pekín', 'Las posiciones controvertidas adoptadas por algunos delegados hicieron que la Conferencia mundial de la Mujer en Pekín se expusiese al fracaso.'),
(4, 'C144', 'Diamantes y rebelión en Sierra Leona', '¿Cómo han influido las rebeliones y otras manifestaciones de la inestabilidad política en la industria de diamantes de Sierra Leona?'),
(5, 'C145', 'Importaciones de arroz en Japón', 'Encontrar documentos que discutan las razones y las consecuencias de las primeras importaciones de arroz en Japón.'),
(6, 'C146', 'Comida rápida en Japón', '¿Qué cadena americana de comida rápida tiene un gran número de restaurantes franquicia en Japón?'),
(7, 'C147', 'Accidentes petrolíferos y aves', 'Encontrar documentos que describan daños o lesiones causadas a las aves por vertidos accidentales de petróleo o polución.'),
(8, 'C148', 'Destrucción de la capa de ozono', '¿Qué agujeros en la capa de ozono no son una consecuencia de la contaminación?'),
(9, 'C149', 'Visita del Papa a Sri Lanka', 'Encontrar informes acerca de las protestas o los problemas causados por las declaraciones previas del Papa acerca del budismo durante su visita a Sri Lanka.'),
(10, 'C150', 'AI contra la pena de muerte', 'Encontrar informes sobre acciones concretas de Amnistía Internacional contra la pena de muerte.'),
(11, 'C151', 'Las maravillas del Mundo Antiguo', 'Busque información sobre la existencia y/o el descubrimiento de los restos de las siete maravillas del mundo.'),
(12, 'C152', 'Los derechos de la infancia', 'Encontrar información sobre la Convención de las Naciones Unidas sobre los derechos de la infancia.'),
(13, 'C153', 'Los Juegos Olímpicos y la paz', 'Encontrar documentos que traten de cómo los Juegos Olímpicos pueden contribuir a la paz mundial.'),
(14, 'C154', 'Libertad de Expresión en Internet', 'Encontrar documentos en los que se hable sobre la censura y la libertad de expresión en Internet.'),
(15, 'C155', 'Riesgos de los teléfonos móviles', '¿Qué riesgos y peligros trae consigo el creciente uso de teléfonos móviles?'),
(16, 'C156', 'Sindicatos en Europa', '¿Qué papel juegan los sindicatos en los distintos países europeos?'),
(17, 'C157', 'Ganadoras de Wimbledon', 'Dar los nombres de las ganadoras del torneo de tenis de Wimbledon femenino.'),
(18, 'C158', 'Fútbol: disturbios en Dublín', 'Encontrar documentos sobre la suspensión del partido internacional de fútbol entre Irlanda e Inglaterra en Dublín tras los disturbios que tuvieron lugar durante el encuentro.'),
(19, 'C159', 'Medio ambiente y petróleo en el Mar del Norte', '¿Qué medidas se han emprendido para proteger el medio ambiente ante el aumento de la exploración y producción de petróleo en el Mar del Norte?'),
(20, 'C160', 'Consumo de whisky escocés', 'Los documentos tratarán sobre la cantidad de whisky escocés consumida por los escoceses, en relación con la cantidad de whisky escocés que exporta Escocia.'),
(21, 'C161', 'Dietas para celíacos', 'Encontrar informes que discutan los problemas de dieta de los celíacos.'),
(22, 'C162', 'Aduanas entre la UE y Turquía', 'Encontrar documentos sobre los problemas planteados por Grecia en relación con la desaparición de aduanas entre la Unión Europea y Turquía.'),
(23, 'C163', 'Restricciones para los fumadores', 'Encontrar documentos sobre normas o leyes cuyo objetivo sea prohibir o limitar el tabaco en restaurantes.'),
(24, 'C164', 'Sentencias sobre drogas en Europa', '¿Qué sentencias se han dictado en Europa por la venta ilegal de drogas?'),
(25, 'C165', 'Globos de Oro 1994', '¿Qué película ganó el Globo de Oro al mejor drama en 1994?'),
(26, 'C166', 'El general francés y la zona de seguridad en los Balcanes', '¿Quién fue el general francés responsable de la creación de la zona de seguridad durante el conflicto de los Balcanes?'),
(27, 'C167', 'Relaciones China-Mongolia', 'Encontrar información sobre las relaciones recientes y acuerdos de cooperación entre China y Mongolia.'),
(28, 'C168', 'Asesinato de Rabin', '¿Quién disparó a Isaac Rabin y por qué?'),
(29, 'C169', 'La aparición de la grabadora de CD', 'Encontrar documentos sobre la grabadora de CD y las reacciones de la industria discográfica.'),
(30, 'C170', 'Lenguas oficiales de la UE', 'Encontrar documentos acerca de los planes franceses para reducir a cinco el número de lenguas oficiales de la Unión Europea.'),
(31, 'C171', 'Final de hockey sobre hielo en Lillehammer', '¿Qué equipos jugaron la final de hockey sobre hielo en los Juegos Olímpicos de Lillehammer en 1994?'),
(32, 'C172', 'Récords mundiales de Atletismo de 1995', '¿Qué nuevas marcas se lograron durante los campeonatos del mundo de 1995 en Göteborg?'),
(33, 'C173', 'Pruebas del quark top', 'Encontrar informes sobre pruebas experimentales de científicos norteamericanos de la existencia del quark top.'),
(34, 'C174', 'Polémica de crucifijos en Bavaria', 'Encontrar documentos sobre la polémica de los crucifijos en las escuelas bávaras.'),
(35, 'C175', 'Impacto medioambiental en los Everglades', 'Encontrar noticias sobre el impacto medioambiental que han sufrido los Everglades, por ejemplo, sobre el causado por la industria azucarera de Florida.'),
(36, 'C176', 'El Shoemaker-Levy y Júpiter', 'Encontrar noticias sobre el impacto del cometa Shoemaker-Levy con el planeta Júpiter.'),
(37, 'C177', 'Consumo de leche en Europa', 'Proporcionar estadísticas o información relativa al consumo de leche en Europa.'),
(38, 'C178', 'Insumisión', 'Encontrar casos de personas que estén dispuestas a ir a la cárcel antes que realizar el servicio militar.'),
(39, 'C179', 'Dimisión del Secretario General de la OTAN', '¿Por qué el Secretario General de la OTAN se vio obligado a dimitir en 1995?'),
(40, 'C180', 'Bancarrota del Barings', '¿Qué magnitud alcanzaron las pérdidas en el caso de la bancarrota del Barings?'),
(41, 'C181', 'Pruebas nucleares francesas', 'Encontrar documentos sobre la presión internacional sobre Francia para poner fin a las pruebas nucleares.'),
(42, 'C182', '50 aniversario del desembarco de Normandía', 'Encontrar informes sobre el lanzamiento de paracaidistas veteranos sobre Sainte-Mère-Église, durante las celebraciones del 50 aniversario del desembarco de Normandía.'),
(43, 'C183', 'Restos de dinosaurios en Asia', '¿En qué partes de Asia han sido encontrados restos de dinosaurio?'),
(44, 'C184', 'Permiso de maternidad en Europa', 'Encontrar documentos que den información acerca de las prestaciones relacionadas con la duración del permiso de maternidad en Europa.'),
(45, 'C185', 'Fotos holandesas de Srebrenica', '¿Qué ha sucedido con las fotografías y películas que hicieron soldados holandeses en Srebrenica que evidenciaban diversas violaciones de los derechos humanos?'),
(46, 'C186', 'Coalición del gobierno holandés', '¿Qué partidos políticos formaron la coalición gobernante, llamada "el gabinete violeta", en Holanda en 1994-1995?'),
(47, 'C187', 'Transporte nuclear en Alemania', 'Encontrar documentos sobre las protestas contra el transporte de material radioactivo con contenedores Castor en Alemania.'),
(48, 'C188', 'Reforma de la ortografía alemana', 'Encontrar documentos que informen sobre la introducción de la reforma de la ortografía alemana para el idioma alemán.'),
(49, 'C189', 'El Hubble y los agujeros negros', '¿Qué papel desempeñó el telescopio Hubble en la demostración de la existencia de los agujeros negros?'),
(50, 'C190', 'Trabajo infantil en Asia', 'Encontrar documentos que hablen del trabajo infantil en Asia y de propuestas para erradicarlo o para mejorar las condiciones laborales de los niños.'),
(51, 'C191', 'Cultivos en el Delta del Ebro', '¿Cuál era el cultivo predominante en el Delta del Ebro a principios de los 90?'),
(52, 'C192', 'Asesinato del director de una cadena de TV en Rusia', '¿Cómo se llamaba el jefe de una cadena de televisión rusa que fue asesinado en la escalera de su domicilio en Moscú?'),
(53, 'C193', 'La UE y los países bálticos', 'Encontrar documentos que hablen sobre las negociaciones entre los países bálticos (Estonia, Letonia o Lituania) y la Unión Europea relacionadas con su adhesión a la UE.'),
(54, 'C194', 'Familia real italiana', 'Encontrar información sobre el exilio de Italia de los miembros varones de la Casa de Saboya.'),
(55, 'C195', 'Huelga de asistentes de vuelo italianos', 'Encontrar referencias acerca de los transtornos o problemas causados por huelgas de asistentes de vuelo en Italia.'),
(56, 'C196', 'Fusión de bancos japoneses', 'Encontrar documentos sobre la fusión del banco japonés Mitsubishi y el Banco de Tokyo para formar el mayor banco del mundo.'),
(57, 'C197', 'Tratado de paz de Dayton', 'Encontrar documentos sobre el acuerdo de paz alcanzado en Dayton sobre Bosnia-Herzegovina.'),
(58, 'C198', 'Oscar honorífico para directores italianos', 'Encontrar información acerca de directores italianos que hayan sido premiados con un Oscar honorífico como reconocimiento a toda su carrera.'),
(59, 'C199', 'Epidemia de ébola en Zaire', 'Encontrar documentos sobre las medidas preventivas tomadas tras el brote epidémico de ébola en el Zaire.'),
(60, 'C200', 'Inundaciones en Holanda y Alemania', 'Encontrar estadísticas sobre las inundaciones en Holanda y Alemania en 1995.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
