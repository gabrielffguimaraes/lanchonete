<?php
require('./dao/LoginDAO.php');
require('./dao/CategoryDAO.php');
require('./dao/IngredientDAO.php');
require('./dao/ProductDAO.php');
require('./dao/ClientDAO.php');
require('./dao/OrderDAO.php');
require('./dao/AddressDAO.php');
require('./dao/AuthDAO.php');

require('./controller/LoginController.php');
require('./controller/CategoryController.php');
require('./controller/IngredientController.php');
require('./controller/ProductController.php');
require('./controller/ClientController.php');
require('./controller/OrderController.php');
require('./controller/AuthController.php');

require('./service/Correios.php');
require('./service/Email.php');

require('./util/Util.php');
require('./util/Authmethods.php');