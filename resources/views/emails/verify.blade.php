<!DOCTYPE html>
<html>
<head lang="en-US">
	<meta charset="utf-8">
</head>
<body>
	 <h2>Verify Your Email Address</h2>

    <div>
        Thanks for creating an account with the verification demo app.
        Please follow the link below to verify your email address
        <a href="{!! url('signup/verify/' . $verification_code) !!}">Verify your account.</a><br/>

    </div>
</body>
</html>