cat > resources/views/auth/login.blade.php << 'EOF'
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - O.S Oficina</title>

    <style>
        body { 
            font-family: 'Figtree', Arial, sans-serif; 
            background: #f8fafc; 
            margin: 0; 
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: #dc2626;
            margin-bottom: 1rem;
            padding: 10px;
            background: #fef2f2;
            border-radius: 4px;
            border: 1px solid #fecaca;
        }
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #1f2937;
        }
        .label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <h1 style="font-size: 1.5rem; color: #1f2937;">
                    🚗 O.S <span style="color: #f97316;">Oficina</span>
                </h1>
            </div>
            
            <h2>Faça login</h2>
            
            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('status'))
                <div style="color: green; margin-bottom: 1rem; padding: 10px; background: #f0fdf4; border-radius: 4px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email -->
                <div>
                    <label class="label" for="email">Email</label>
                    <input class="form-input" id="email" type="email" name="email" 
                           value="{{ old('email', 'marcelfinavaro@teste.com') }}" required autofocus>
                    @error('email')
                        <div style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="label" for="password">Senha</label>
                    <input class="form-input" id="password" type="password" name="password" 
                           value="12345678" required>
                    @error('password')
                        <div style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom: 1rem;">
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" name="remember" style="margin-right: 8px;">
                        <span style="color: #6b7280;">Lembrar de mim</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="btn">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
EOF