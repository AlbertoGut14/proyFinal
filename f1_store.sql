-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2025 a las 20:53:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `f1_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario`, `producto`, `cantidad`) VALUES
(6, 1, 4, 1),
(7, 1, 28, 1),
(8, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `usuario`, `producto`, `cantidad`) VALUES
(1, 3, 28, 1),
(2, 1, 2, 1),
(3, 1, 20, 1),
(4, 1, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fotos` varchar(250) NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fab` varchar(50) NOT NULL,
  `origen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `fotos`, `precio`, `cantidad`, `fab`, `origen`) VALUES
(1, 'Gorra Mercedes', 'La gorra adidas F1 2025 Team Mercedes AMG Petronas - Blanco es un producto oficial. Tiene una visera precurvada, cierre trasero ajustable y el logo del equipo. Está hecha con al menos 50% de materiales reciclados, con un corte estructurado y corona media.', 'https://images.footballfanatics.com/mercedes-amg-petronas-f1-team/mercedes-amg-petronas-adidas-f1-2025-team-cap-white_ss5_p-202359126+pv-1+u-i2va1m1cq4yea94uc4ni+v-fdpmbyk8wu3snemkvt7i.jpg?_hv=2&w=900', 850, 15, 'Adidas', 'China'),
(2, 'Gorra Williams Racing', 'La gorra oficial del equipo Williams Racing PUMA para la temporada 2025 de Fórmula 1. Tiene el logotipo de Williams Racing en el panel frontal, estampado del equipo bajo la visera y cierre a presión ajustable posterior. Está hecha de 100% poliéster.', 'https://images.footballfanatics.com/williams-racing/williams-racing-2025-team-cap-navy_ss5_p-202359071+pv-1+u-lc0hdenjnrgat79hu1f1+v-fvawvoyn7dregmznwm47.jpg?_hv=2&w=900', 800, 4, 'Puma', 'Filipinas'),
(3, 'Gorra VCARB', 'La gorra VCARB New Era Team Cap - White es un producto oficial. Tiene una visera curva, correa de tela ajustable con hebilla deslizante y un corte estructurado con corona media.', 'https://images.footballfanatics.com/vcarb/vcarb-new-era-team-ponytail-cap-white-womens_ss5_p-202169026+pv-1+u-dz2dxwxvervu8flmh4hj+v-hnszbvhhx56ri1txj5ds.jpg?_hv=2&w=900', 1050, 5, 'New Era', 'China'),
(4, 'Gorra Haas', 'La gorra Haas F1 New Era Team Ollie Bearman 9SEVENTY Camo Cap - Black. Tiene un perfil 9SEVENTY ajustable, corona estructurada de 6 paneles, visera curva con detalle de ribete rojo y cierre ajustable Stretch Snap. Presenta un estampado de camuflaje en los paneles frontales y la parte superior de la visera. Además, tiene el logotipo de MoneyGram Haas F1 en la parte delantera y un parche del equipo en el lateral derecho.', 'https://images.footballfanatics.com/haas-f1-team/haas-f1-new-era-team-ollie-bearman-9seventy-camo-cap-black_ss5_p-202169033+pv-1+u-wedfxzawzk2kyzj4esyz+v-zfkvvuqadpvgbptlvjxr.jpg?_hv=2&w=900', 1000, 5, 'New Era', 'Hong Kong'),
(5, 'Gorra Aston Martin', 'La gorra de Aston Martin de edición especial del Gran Premio de Miami. Con el icónico logo de Aston Martin en el frontal y una vibrante combinación de verde y lima. Está hecha con un corte estructurado y corona media.', 'https://images.footballfanatics.com/aston-martin/aston-martin-special-edition-miami-cap-green-/-lime_ss5_p-202163057+pv-1+u-57cra9dfpkjjyxpioubc+v-eddqmfed1ei2ng7tx60h.jpg?_hv=2&w=1018', 1000, 7, 'Boss', 'Filipinas'),
(6, 'Gorra Alpine', 'La gorra Alpine F1 New Era 9SEVENTY Stretch Snap Pierre Gasly - Azul Marino añade un toque de velocidad a cualquier otra prenda para que puedas mostrar tu apoyo en la pista y en otros lugares. Tiene un perfil 9SEVENTY ajustable, cierre ajustable en la nuca, visera curva, corona de 6 paneles, ojales de refrigeración, el logotipo del equipo en la parte delantera de la corona y el logotipo bordado.', 'https://images.footballfanatics.com/alpine/alpine-f1-new-era-9seventy-stretch-snap-pierre-gasly-cap-navy_ss5_p-202169050+pv-1+u-hckm3ybujllxil45gos4+v-h2vwcvysz9syvq1ok3se.jpg?_hv=2&w=900', 1050, 10, 'New Era', 'China'),
(7, 'Gorra RedBull Racing', 'La gorra Red Bull Racing New Era Max Verstappen 9SEVENTY Piped Cap - Navy es un producto oficial. Tiene un perfil 9SEVENTY ajustable, cierre ajustable en la nuca, visera curva, corona de 6 paneles, ojales de refrigeración y el logotipo del equipo.', 'https://images.footballfanatics.com/red-bull-racing/red-bull-racing-new-era-max-verstappen-9seventy-piped-cap-navy_ss5_p-202169037+pv-1+u-bseveoofibb3mgrjxwql+v-kntwblaym7jdybae01tf.jpeg?_hv=2&w=900', 1050, 15, 'New Era', 'China'),
(8, 'Gorra McLaren', 'La gorra McLaren New Era Oscar Piastri 9SEVENTY Stretch Snap - Papaya tiene una visera curva, un cierre de broche ajustable y una corona de 6 paneles con paneles de malla para ventilación. La gorra presenta un logotipo tridimensional, el nombre del piloto y el número del coche, y gráficos bordados. Tiene una corona media y un corte estructurado.', 'https://images.footballfanatics.com/mclaren-f1-team/mclaren-new-era-oscar-piastri-9seventy-stretch-snap-cap-papaya_ss5_p-202169059+pv-1+u-xuopbztz3o3t3wm0oygj+v-gowk5nhbpzb4kkre6hpt.jpg?_hv=2&w=900', 1000, 10, 'New Era', 'China'),
(9, 'Gorra Sauber', 'La gorra Stake F1 Team Kick Sauber 2025 de Nico Hulkenberg es un producto oficial. Tiene detalles distintivos de costuras en verde contrastante y paneles de malla a juego que crean un estilo deportivo inspirado en las carreras. Cuenta con un diseño de visera curva con paneles frontales estructurados y gráficos bordados para un acabado profesional. Los paneles traseros de malla transpirable ayudan a mantener la comodidad durante el uso prolongado.', 'https://images.footballfanatics.com/kick-sauber/stake-sauber-f1-team-2025-nico-hulkenberg-driver-cap_ss5_p-202596053+pv-1+u-eazjqymsxlxrjf6geylz+v-vl4ysvfycob2xgyfl4la.jpg?_hv=2&w=900', 1100, 5, 'New Era', 'China'),
(10, 'Gorra Ferrari', 'La gorra del equipo Lewis Hamilton Scuderia Ferrari 2025 - Rojo tiene una estructura en forma de A, cierre ajustable en la nuca y ala curva. Cuenta con el logotipo cosido y gráficos bordados. Está hecha con un corte estructurado y corona media.', 'https://images.footballfanatics.com/scuderia-ferrari/scuderia-ferrari-2025-team-lewis-hamilton-cap-red_ss5_p-202358980+pv-1+u-cyv4xtwh0yojc1dmjekk+v-y7oh4sonuwmqcrj21acg.jpg?_hv=2&w=900', 1020, 10, 'Puma', 'Filipinas'),
(11, 'LEGO McLaren F1 Team MCL38', '¡Construye el McLaren F1 Team MCL38 LEGO Speed Champions! Edad recomendada: 10+ años. 269 piezas. Incluye minifigura de piloto y reproduce detalles del auto de carreras 2024. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81z4M1VZbAL._AC_SX522_.jpg', 650, 7, 'Lego', 'Dinamarca'),
(12, 'Lego Kick Sauber F1 Team C44', '¡Construye el Auto de Carreras Kick Sauber F1 Team C44 LEGO Speed Champions! Edad recomendada: 10+ años. 259 piezas. Incluye minifigura de piloto y reproduce detalles del diseño 2024, como el alerón trasero y las llantas anchas. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81zFNvWrzML._AC_SX522_.jpg', 680, 6, 'Lego', 'Dinamarca'),
(13, 'Lego Racing Bulls F1 Team VCARB 01', '¡Construye el Auto de Carreras Visa Cash App RB VCARB 01 F1 LEGO Speed Champions! Edad recomendada: 18+ años. 248 piezas. Incluye una minifigura de piloto y reproduce detalles del diseño 2024, como calcomanías de los patrocinadores, halo y llantas anchas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81XoxZKa-UL._AC_SX522_.jpg', 560, 10, 'Lego', 'Dinamarca'),
(14, 'Lego Aston Martin F1 Team AMR24', '¡Construye el Auto de Carreras Aston Martin Aramco F1 AMR24 LEGO Speed Champions! Edad recomendada: 10+ años. 269 piezas. Incluye una minifigura y reproduce la autenticidad del estilo Aston Martin Aramco F1. Ideal para diversión en familia y fans de la F1.\r\n', 'https://m.media-amazon.com/images/I/81Jjz2XS2vL._AC_SX522_.jpg', 550, 14, 'Lego', 'Dinamarca'),
(15, 'Lego Mercedes-AMG F1 Team W15', '¡Construye el Auto de Carreras Mercedes-AMG F1 W15 LEGO Speed Champions! Edad recomendada: 10+ años. 267 piezas. Incluye minifigura de piloto, detalles de diseño 2024, alerón trasero y llantas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/819-16TlCZL._AC_SX522_.jpg', 609, 10, 'Lego', 'Dinamarca'),
(16, 'Lego Williams Racing F1 FW46', '¡Construye el Auto de Carreras Williams Racing FW46 F1 LEGO Speed Champions! Edad recomendada: 10+ años. 263 piezas. Incluye minifigura de piloto, detalles de diseño 2024, alerón trasero y llantas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81FemWE9amL._AC_SX522_.jpg', 680, 10, 'Lego', 'Dinamarca'),
(17, 'Lego Scuderia Ferrari F1 SF24', '¡Construye el Auto de Carreras Ferrari SF-24 F1 LEGO Speed Champions! Edad recomendada: 10+ años. 275 piezas. Incluye un modelo construible y una minifigura. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81+vIw2yt1L._AC_SX679_.jpg', 600, 17, 'Lego', 'Dinamarca'),
(18, 'Lego RedBull Racing F1 RB20', '¡Construye el Auto de Carreras Oracle Red Bull Racing F1 RB20 LEGO Speed Champions! Edad recomendada: 18+ años. 251 piezas. Incluye minifigura de piloto, detalles de diseño 2024, alerón trasero y llantas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81oplZow5nL._AC_SX522_.jpg', 575, 13, 'Lego', 'Dinamarca'),
(19, 'Lego BWT Alpine F1 Team A524', '¡Construye el Auto de Carreras BWT Alpine F1 Team A524 LEGO Speed Champions! Edad recomendada: 10+ años. 267 piezas. Incluye minifigura de piloto, detalles de diseño 2024, alerón trasero y llantas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81sRa75qj8L._AC_SX522_.jpg', 680, 8, 'Lego', 'Dinamarca'),
(20, 'Lego MoneyGram Haas F1 Team VF-24', '¡Construye el Auto de Carreras MoneyGram Haas F1 Team VF-24 LEGO Speed Champions! Edad recomendada: 10+ años. 242 piezas. Incluye minifigura de piloto, detalles de diseño 2024, alerón trasero y llantas Pirelli. Fomenta la creatividad y habilidades de construcción.', 'https://m.media-amazon.com/images/I/81gs6QgCgLL._AC_SX522_.jpg', 620, 10, 'Lego', 'Dinamarca'),
(21, 'Llavero Pirelli Hard Tire', '¿Qué souvenir podría ser más adecuado para un aficionado a la Fórmula Uno? Dales a tus llaves un toque de espíritu de carreras con este gran souvenir y lleva tu afición a las carreras a dondequiera que vayas. Un llavero del neumático duro de Pirelli - Blanco.', 'https://images.footballfanatics.com/pirelli/pirelli-hard-tyre-keyring-white_ss5_p-201896712+pv-1+u-fn39lykjlphvajjoiacb+v-bsv5narxeuctmi2zfczi.jpg?_hv=2&w=900', 350, 14, 'Pirelli', 'Italia'),
(22, 'Llavero Pirelli Medium Tire', '¿Qué souvenir podría ser más adecuado para un aficionado a la Fórmula Uno? Dales a tus llaves un toque de espíritu de carreras con este gran souvenir y lleva tu afición a las carreras a dondequiera que vayas. Un llavero del neumático medio de Pirelli - Amarillo.', 'https://images.footballfanatics.com/pirelli/pirelli-medium-tyre-keyring-yellow_ss5_p-201896711+pv-1+u-d7fgexnyuamsa3abwdnv+v-lh8tusa16gij7ewuoexf.jpg?_hv=2&w=900', 350, 15, 'Pirelli', 'Italia'),
(23, 'Llavero Pirelli Soft Tire', '¿Qué souvenir podría ser más adecuado para un aficionado a la Fórmula Uno? Dales a tus llaves un toque de espíritu de carreras con este gran souvenir y lleva tu afición a las carreras a dondequiera que vayas. Un llavero del neumático blando de Pirelli - Rojo.', 'https://images.footballfanatics.com/pirelli/pirelli-soft-tyre-keyring-red_ss5_p-201896710+pv-1+u-lfbmuzimokn8zjjyrcay+v-nmyff4tcsf532ausagbf.jpg?_hv=2&w=900', 350, 15, 'Pirelli', 'Italia'),
(24, 'Sudadera con capucha - F1 Vintage Car', 'Demuestra tu pasión por la Fórmula 1 con esta sudadera de diseño vintage. Con capucha ajustable, bolsillo canguro y gráficos impresos. Comodidad y estilo en cualquier temporada.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-distressed-car-graphic-hoodie_ss5_p-200782176+pv-1+u-whgeahibtokvbur0edls+v-zxeecxnrv5vwelhg3fga.jpg?_hv=2&w=900', 1500, 10, 'Formula 1', 'Turquía'),
(25, 'Sudadera con capucha y corte deportivo - F175', 'Luce tu pasión por la F1 con esta sudadera oficial. Diseño moderno en negro con logo F175 al frente. Incluye capucha con cordón, bolsillo canguro y puños de canalé. Ideal para cualquier temporada.​\r\n\r\n', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-f175-lc-logo-hoodie-black_ss5_p-202897948+pv-1+u-qwhnndkmmnhmjer05xgn+v-mbsuutvzlr15htauov0x.jpg?_hv=2&w=900', 1500, 11, 'Formula 1', 'Bangladesh'),
(26, 'Sudadera ligera Fórmula 1 - Gris tormenta', 'Consigue una sensación más cálida con esta fantástica sudadera. La marca icónica de F1 es, sin duda, una forma excelente de mostrar tu apoyo, haga el tiempo que haga.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-elevated-lightweight-hoodie-storm-grey_ss5_p-201850833+pv-1+u-dpzxle7gxbgfq5bhh0jr+v-vfnewbhcmnrs5z33fa9a.jpg?_hv=2&w=900', 1700, 10, 'Formula 1', 'Tailandia'),
(27, 'Gorra Pirelli Podio', 'Luce como un campeón con la gorra oficial del podio de F1. Diseño negro con logo Pirelli bordado, laurel en la visera y \"1st\" en el lateral. Ajuste cómodo con correa metálica y 100% algodón. La misma que usan los ganadores en el podio.​', 'https://images.footballfanatics.com/pirelli/pirelli-podium-cap_ss5_p-201896713+pv-1+u-8omk2ocxc1fsjffownam+v-ccm8bgbqaok3sbjupkbo.jpg?_hv=2&w=1018', 1020, 15, 'Pirelli', 'China'),
(28, 'Gorra Formula 1 Delay - Verde azulado', 'Estilo relajado y auténtico para fanáticos de la F1. Diseño sin estructura, visera curva y correa ajustable. Color verde azulado que destaca en cualquier ocasión. Ideal para lucir tu pasión por la velocidad con comodidad.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-delay-unstructured-cap-teal_ss5_p-201039859+pv-1+u-1n4nxlhpurbcnkp36jtz+v-fiiqy3djmhwl2xyxx1qy.jpg?_hv=2&w=900', 500, 17, 'Vietnam', 'Formula 1'),
(29, 'Polo del Gran Premio de México', 'Luce como un profesional con este polo oficial del GP de México. Diseño moderno con cremallera 1/4, cuello alto y bajo trasero extendido. Fabricado en Indonesia con materiales de alta calidad. Ideal para cualquier ocasión.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-mexico-grand-prix-tech-polo_ss5_p-201238542+pv-1+u-eknaplcsw4jwcaho2doi+v-5l2vatjv17u7sazium2j.jpg?_hv=2&w=900', 700, 5, 'Formula 1', 'Indonesia'),
(30, 'Camiseta - Año de la serpiente F1', 'Celebra el Año de la Serpiente con esta camiseta oficial de edición limitada. Diseño elegante con gráficos inspirados en la serpiente y el logo de F1. Corte unisex, de color negro y ajuste regular para máxima comodidad. Ideal para fanáticos que buscan estilo y exclusividad.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-year-of-the-snake-t-shirt-black-unisex_ss5_p-202794766+pv-1+u-fsfalsomuzltp4no2bhx+v-rguzyzwp0fxscmeuq0lw.jpg?_hv=2&w=1018', 1100, 15, 'Formula 1', 'Bangladesh'),
(31, 'Camiseta - F175 Blanca', 'Demuestra tu pasión por la F1 con esta camiseta oficial en color blanco. Diseño clásico con el logo F175 en el pecho. Confeccionada en algodón suave, cuello redondo y corte regular. Ideal para lucir estilo y comodidad en cualquier ocasión', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-f175-primary-logo-t-shirt-white_ss5_p-202897950+pv-1+u-c8o4bsijshyatyc5mx8v+v-tj8l7c654lmu9ejoaj8v.jpg?_hv=2&w=900', 700, 11, 'Formula 1', 'Bangladesh'),
(32, 'Camiseta gráfica - F1', 'Demuestra tu pasión por la F1 con esta camiseta oficial en color beige. Diseño moderno con gráficos impresos, cuello redondo y corte regular. Con materiales de alta calidad. Ideal para cualquier ocasión.', 'https://images.footballfanatics.com/formula-1-merchandise/formula-1-edge-graphic-t-shirt_ss5_p-201326987+pv-1+u-axm9ui18j8qthopl3ydu+v-g7r3aau4kfepvo3u2nwo.jpg?_hv=2&w=900', 800, 14, 'Formula 1', 'Bangladesh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `nacimiento` date NOT NULL,
  `tarjeta` varchar(16) NOT NULL,
  `cp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `nacimiento`, `tarjeta`, `cp`) VALUES
(1, 'Alberto', 'alberto@example.com', 'alberto123', '2003-07-01', '1234888899991234', '64346'),
(3, 'Administrador', 'admin@admin.com', 'admin123', '2000-01-01', '0000000000000000', '52786');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrito-usuario` (`usuario`) USING BTREE,
  ADD KEY `compra-producto` (`producto`) USING BTREE;

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto` (`producto`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
