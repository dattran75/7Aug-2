<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background: #fff !important; margin: 0 auto; margin-top: 30px; width: 90%; font-size: 14px; color: #333333; border: 1px solid #e1e1e1;">
	<div style="margin: 0 auto; width: 90%">
		<div style="margin-bottom: 25px;">
			<h3>{{ $mailData['title'] }}</h3>
            <h4> Chào mừng tới hệ thống</h4>
			<h4>Email đăng nhập : {{$mailData['email']}}</h4>
            <h4>Tên đăng nhập : {{$mailData['username']}}</h4>
            <h4>Mật khẩu là : {{$mailData['password']}}</h4>
		</div>
		<p>Thân gửi,</p>
	</div>	
	<div style="width: 30%; margin-top: 50px;">
    	<img src="https://menuonline.vn/images/logo/Logo-MenuOnline.png" alt="logo" class="img-responsive" style="width: 100%">
  	</div>
</body>
</html>