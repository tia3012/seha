<?php include('includes/header.php'); ?>
<main>
    <section class="inquiry-section">
        <h1>الإجازات المرضية</h1>
        <p>خدمة الاستعلام عن الإجازات المرضية تتيح لك حالة طلبك للإجازة ومكنك طباعتها عن طريق تطبيق صحتي.</p>
        <form method="POST" action="process.php">
    <label for="identity_number">رقم الهوية/الإقامة:</label>
    <input type="text" name="identity_number" id="identity_number" required>
    
    <label for="service_code">رمز الخدمة:</label>
    <input type="text" name="service_code" id="service_code" required>
    
    <button type="submit">استعلام</button>
</form>

        <a href="#" class="btn secondary">رجوع للاستعلامات</a>
    </section>
</main>
<?php include('includes/footer.php'); ?>
