<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51LY2cbBn7oZyYubPDEND6ybxxDokHQJ39v3pFoW3UFasceJgxweUt17VyhQAiK5rFM2MGRL2b1ymDyEegdU6Hk5w00UnwA8Mlq";

$secretKey="sk_test_51LY2cbBn7oZyYubPAS0HcJCKgPxopQxftdGAKO7F8GATreQ4d8zAVzCToILoQE7EbCnrSWbd24L6qDc5uQvNltxq00Lns4vmgS";

\Stripe\Stripe::setApiKey($secretKey);
?>