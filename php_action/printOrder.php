<?php    

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_place,gstn FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$payment_place = $orderData[10];
$gstn = $orderData[11];


$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
   INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '<style>
.star img {
    visibility: visible;
}</style>
<table align="center" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid black; margin-bottom: 10px;">
               <tbody>
                  <tr>
                     <td colspan="5" style="text-align:center; font-size: 25px;">ELITE PIPES</td>
                  </tr>
                  <tr>                    
                     <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="3" style="font-style: italic; font-weight: 600; text-decoration: underline; font-size: 25px;">TAX INVOICE</td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="3">Elite Pipes</td>
                  </tr>
                  <tr>
                     <td colspan="3">1,Thundukadu Mettur,Verappam Palayam(PO)</td>
                     </tr>
                     <tr>
                     <td colspan="3">Arachalur(VIA),Erode-638101.</td>            
                  </tr>
                  <tr>
                     <td colspan="3">Mobile No: 9944882450 </td>
                  </tr>
                  <tr>
                     <td colspan="3">elitepipes@gmail.com</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>                  
                    <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="2" style="padding: 0px; vertical-align: top; border-right: 1px solid black;">
                        <table align="left" cellpadding="0" cellspacing="0" style="border: 1px solid black; width: 100%">
                           <tbody>
                              <tr>
                                 <td style="width: 74px; vertical-align: top;" rowspan="3">To, </td>
                                 <td>&nbsp;'.$clientName.'</td>
                              </tr>
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom: 1px solid black;">&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                        <table align="left" cellspacing="0" style="width: 100%; border-right: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black;">
                           <tbody>
                              <tr>
                                 <td style="border-bottom: 1px solid black;">GSTAMOUNT: '.$gstn.'</td>
                                 <td style="border-left: 1px solid black; border-bottom: 1px solid black;">Contact: '.$clientContact.'</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                     <td style="padding: 0px; vertical-align: top;" colspan="3">
                        <table align="left" cellpadding="0" cellspacing="0" style="width: 100%">
                           <tbody>
                              <tr>
                                 <td style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;"></td>
                              </tr>
                              <tr>
                                 <td style="border-bottom: 1px solid black; border-right: 1px solid black;">Date: '.$orderDate.'</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom: 1px solid black; height: 52px; border-right: 1px solid black;">GSTIN:33AEHPY0926J1Z9</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 123px; text-align: center; background-color: black; color: white; border: 1px solid black;">S.No</td>
                     <td style="width: 50%; text-align: center; border: 1px solid black; background-color: black; color: white;">Description Of Goods</td>
                     <td style="width: 150px; text-align: center; border: 1px solid black; background-color: black; color: white;">Qty.</td>
                     <td style="width: 150px; text-align: center; border: 1px solid black; background-color: black; color: white;">Rate  Ps</td>
                     <td style="width: 150px; text-align: center; border: 1px solid black; background-color: black; color: white;">Amount  Ps</td>
                  </tr>';
                  $x = 1;
                  $cgst = 0;
                  $igst = 0;
                  if($payment_place == 2) {
                     $igst = $subTotal * 18 / 100;
                  } else {
                     $cgst = $subTotal * 9 / 100;
                  }
                  $total = $subTotal + 2 * $cgst + $igst;
            while($row = $orderItemResult->fetch_array()) {       
                        
               $table .= '<tr>
                     <td style="border: 1px solid black;">'.$x.'</td>
                     <td style="border: 1px solid black;">'.$row[4].'</td>
                     <td style="border: 1px solid black;">'.$row[2].'</td>
                     <td style="border: 1px solid black;">'.$row[1].'</td>
                     <td style="border: 1px solid black;">'.$row[3].'</td>
                  </tr>
               ';
            $x++;
            } // /while
                $table .= '
                  <tr style="border: 1px solid black;">
                     <td style="border: 1px solid black;"></td>
                     <td style="border: 1px solid black;"></td>
                     <td style="border: 1px solid black;"></td>
                     <td style="width: 149px; border: 1px solid black; background-color: #fff; color: black; padding-left: 5px;">Total</td>
                     <td style="width: 218px; border: 1px solid black;">'.$subTotal.'</td>
                  </tr>
                  <tr>
                     <td colspan="3"></td>
                     <td rowspan="2" style="border: 1px solid black; background-color: #fff; color: black; padding-left: 5px;">SGST. 9%</td>
                     <td rowspan="2" style="border: 1px solid black;">'.$cgst.'</td>
                  </tr>
                  <tr>
                     <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="3"></td>
                     <td style="border: 1px solid black; background-color: #fff; color: black; padding-left: 5px;">CGST 9%</td>
                     <td style="border: 1px solid black;">'.$cgst.'</td>
                  </tr>
                  <tr>
                     <td colspan="3"></td>
                     <td style="border: 1px solid black; background-color: #fff; color: black; padding: 5px;">I.G.S.T. 18%</td>
                     <td style="border: 1px solid black;">'.$igst.'</td>
                  </tr>
                  <tr>
                     <td colspan="3"></td>
                     <td style="border: 1px solid black; background-color: #fff; color: black; padding: 5px;">G. Total</td>
                     <td style="border: 1px solid black;">₹'.$total.'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-left: 1px solid black; border-bottom: 1px solid black; padding: 5px; border-right: 1px solid black;"><span style="float: right;"></span></td>
                     <td rowspan="2" colspan="2" style="vertical-align: bottom; padding: 5px; color: red; border-right: 1px solid black; text-align: center;"></td>
                  </tr>         
               </tbody>
            </table>';
$connect->close();

echo $table;
