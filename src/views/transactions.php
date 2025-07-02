<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($transactions)) { $totalExpense = 0; $totalIncome = 0; ?>
                    <?php foreach($transactions as $transaction)
                    {
                        $date = date('M j, Y', strtotime($transaction[0]));
                        $checkNumber = htmlspecialchars($transaction[1]);
                        $description = htmlspecialchars($transaction[2]);
                        $amount = htmlspecialchars($transaction[3]);
                        $amount = str_replace('$', '', $amount);
                        $amount = str_replace(',', '', $amount);                        
                    ?>
                        <tr>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $checkNumber; ?></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <?php 
                                if($amount < 0) 
                                { 
                                    $totalExpense += $amount; 
                                    $amount = 'R$ ' . number_format($amount, 2, ',', '.');
                                    echo "<span style='color:red;'>$amount</span>"; 
                                } 
                                else 
                                { 
                                    $totalIncome += $amount;
                                    $amount = 'R$ ' . number_format($amount, 2, ',', '.');
                                    echo "<span style='color:green;'>$amount</span>"; 
                                } 
                                ?>
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                <?php 
                } 
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td style="color: green;"><b><?php echo 'R$ ' . number_format($totalIncome, 2, ',', '.'); ?></b></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td style="color: red;"><b><?php echo 'R$ ' . number_format($totalExpense, 2, ',', '.'); ?></b></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><b><?php echo 'R$ ' . number_format($totalIncome + $totalExpense, 2, ',', '.'); ?></b></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
