<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login & Register Form</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset("style/loginstyle.css") }}" />
    </head>
	<body>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form action="{{ route("register.store") }}" method="post">
					@csrf
					<h1 style="margin-bottom: 1rem">Register</h1>
					<input type="number" name="phone" value="{{ old("phone") }}" placeholder="Phone" required/>
					@error ('phone') 
						<div class="error-container">
							<p class="message-error register">{{ $message }}</p>
						</div>	
					@enderror
					<input type="text" name="username" value="{{ old("username") }}" placeholder="Username" required/>
					@error ('username') 
						<div class="error-container">
							<p class="message-error register">{{ $message }}</p>
						</div>	
					@enderror
					<input type="email" name="email" value="{{ old("email") }}" placeholder="Email" required/>
					@error ('email') 
						<div class="error-container">
							<p class="message-error register">{{ $message }}</p>
						</div>	
					@enderror
					<input type="password" name="password" value="{{ old("password") }}" placeholder="Password" required/>
					@error ('password') 
						<div class="error-container">
							<p class="message-error register">{{ $message }}</p>
						</div>	
					@enderror
					<input type="password" name="password_confirmation" value="{{ old("password_confirmation") }}" placeholder="Password Confirm" required/>
					@error ('password_confirmation') 
						<div class="error-container">
							<p class="message-error register">{{ $message }}</p>
						</div>	
					@enderror
					@if (session()->has("RegisError")) 
						<p class="message-error">{{ session("RegisError") }}</p>
					@endif
					<button type="submit" name="register" style="margin-top: 0.5rem">Register</button>
				</form>
			</div>
			<div class="form-container sign-in-container">
				<form action="{{ route('login.store') }}" method="post">
					@csrf
					<h1 style="margin-bottom: 1rem">Login</h1>
					<input type="text" name="username" placeholder="Username" required />
					<input type="password" name="password" placeholder="Password" required />
					@if (session()->has("loginError")) 
						<p class="message-error">{{ session("loginError") }}</p>
					@endif
					@if (session()->has("success")) 
						<p class="message-success">{{ session("success") }}</p>
					@endif
					<a style="cursor: pointer;" onclick="alert('Belum Berfungsi')">Lupa password</a>
					<div class="button-form">
						<button type="submit">Login</button>
					</div>
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Tips</h1>
						<p>Gunakan lah email yang valid dan gunakanlah username yang mudah diingat, buatlah password dengan kombinasi angka dan huruf agar sulit ditebak</p>
						<button class="ghost" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Tips</h1>
						<p>Jangan beritahukan data pribadi anda, termasuk username dan password saat menggunakan semua sistem informasi</p>
						<button class="ghost" id="signUp">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function() {
				const signUpButton = document.getElementById("signUp");
				const signInButton = document.getElementById("signIn");
				const container = document.getElementById("container");
				const errorRegister = document.querySelectorAll(".message-error.register");
				
				if (errorRegister.length != 0) {
					container.classList.add("right-panel-active");
				}

				signUpButton.addEventListener("click", () => {
					container.classList.add("right-panel-active");
				});
				signInButton.addEventListener("click", () => {
					container.classList.remove("right-panel-active");
				});
			});
		</script>
	</body>
</html>