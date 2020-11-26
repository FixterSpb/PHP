<table>
    <tr>
        <th>№ п/п</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
        <th></th>
    </tr>
    <?php $i = 1; foreach ($products as $item): ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $item['name'] ?></td>
        <td><?= $item['price'] ?></td>
        <td><input type="number" min="1" max="1000" value="<?= $item['qty'] ?>">
        </td>
        <td><?= $item['amount'] ?></td>
        <td><a href="api/products/?id=<?= $item['id'] ?>&action='delete'">X</a></td>
    </tr>
    <?php $i++; endforeach; ?>
</table>

