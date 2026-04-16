        </div><!-- /.card-body -->
    </div><!-- /.email-card -->

    <!-- Footer -->
    <div class="email-footer">
        <p>© {{ date('Y') }} {{ $adminSetting->site_name ?? 'QFSWORLD' }}. All rights reserved.</p>
        @if(!empty($adminSetting->support_email))
        <p>Questions? <a href="mailto:{{ $adminSetting->support_email }}">{{ $adminSetting->support_email }}</a></p>
        @endif
        <p style="margin-top:8px;">This is an automated message — please do not reply directly.</p>
    </div>

</div><!-- /.email-container -->
</div><!-- /.email-wrapper -->
</body>
</html>
