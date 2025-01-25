<?php
use App\Helpers\TransactionFormatter;
?>

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
                <?php if(!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction):
                        $color = $transaction['amount'] < 0 ? 'red' : 'green';
                        ?>
                        <tr>
                            <td><?= TransactionFormatter::date($transaction['date']) ?></td>
                            <td><?= $transaction['check_number'] ?></td>
                            <td><?= $transaction['description'] ?></td>
                            <td style="color: <?= $color ?>"><?= TransactionFormatter::dollars($transaction['amount']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">No transactions yet. <a href="/">Upload transactions</a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= TransactionFormatter::dollars($totals['income']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= TransactionFormatter::dollars($totals['expense']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= TransactionFormatter::dollars($totals['total']); ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
