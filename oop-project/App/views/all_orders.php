<?php

use Oop\Project\Order;

$orderModel = new Order($db);
$orders = $orderModel->getAllOrders();
?>

<div class="container my-5">
    <h2 class="mb-4">📦 جميع الطلبات</h2>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info">
            لا توجد طلبات حالياً
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم العميل</th>
                    <th>الهاتف</th>
                    <th>طريقة الدفع</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['phone']) ?></td>
                        <td><?= htmlspecialchars($order['payment_type']) ?></td>
                        <td>
                            <span class="badge bg-<?= $order['status'] === 'completed' ? 'success' : 'warning' ?>">
                                <?= htmlspecialchars($order['status']) ?>
                            </span>
                        </td>
                        <td><?= $order['created_at'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
