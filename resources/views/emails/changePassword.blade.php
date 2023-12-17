<p>Hello,</p>

<p>To reset your password, click the link below:</p>

<a href="{{ route('password.reset.email', ['token' => $resetToken]) }}">
    Reset Password
</a>

<p>If you didn't request a password reset, you can ignore this email.</p>
