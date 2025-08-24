<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>HMS: Print</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td align="top"><img src="" alt="" width="150"/><h3>Payment Report</h3></td>
        
        <td align="right">
            <h3>House Rental System Payment Report</h3>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>From:</strong><?php echo ucwords($row['ofname']) ." ". ucwords($row['olname'])?></td>
        <td align="right"><strong>To:</strong><?php echo ucwords($row['tfname']) ." ". ucwords($row['tmname']) ." ". ucwords($row['tlname'])?></td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>Payment ID:</th>
        <th>Monthly Rent</th>
        <th>Date</th>
        <th>Ampunt Paid</th>
      </tr>
    </thead>
    <tbody>

    <?php 
        foreach($payment_fetch as $payment_fetchs){
    ?>
      <tr>
        <th scope="row"><?php echo $payment_fetchs['Payment_ID'] ?></th>
        <td align="center"> <?php echo "P " . $payment_fetchs['Amount_To_Pay'] ?></td>
        <td align="right"><?php echo $payment_fetchs['Date'] ?></td>
        <td align="right"><?php echo $payment_fetchs['Amount_Paid'] ?></td>
      </tr>
      <?php 
        }
      ?>
    </tbody>
    <br>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td align="right">Subtotal $</td>
            <td align="right"><?php echo $row_amounts['SUM(Amount_Paid)'] ?></td>
        </tr>
    </tfoot>
  </table>

</body>
</html>