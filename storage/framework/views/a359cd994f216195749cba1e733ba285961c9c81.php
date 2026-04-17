        </div><!-- /.card-body -->
    </div><!-- /.email-card -->

    <!-- Footer -->
    <div class="email-footer">
        <p>© <?php echo e(date('Y')); ?> <?php echo e($adminSetting->site_name ?? 'QFSWORLD'); ?>. All rights reserved.</p>
        <?php if(!empty($adminSetting->support_email)): ?>
        <p>Questions? <a href="mailto:<?php echo e($adminSetting->support_email); ?>"><?php echo e($adminSetting->support_email); ?></a></p>
        <?php endif; ?>
        <p style="margin-top:8px;">This is an automated message — please do not reply directly.</p>
    </div>

</div><!-- /.email-container -->
</div><!-- /.email-wrapper -->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/emails/_layout_close.blade.php ENDPATH**/ ?>