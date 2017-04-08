<?php
include('phpqrcode/qrlib.php');
$address = $_GET['address'];
QRcode::png($address);
