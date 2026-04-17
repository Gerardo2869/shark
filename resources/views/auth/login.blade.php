<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Inventario</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --border-color: #d2d2d7;
            --input-bg: #f5f5f7;
            --primary-color: #0071e3;
            --primary-hover: #0077ed;
            --focus-ring: rgba(0, 113, 227, 0.4);
            --error-color: #d93d3b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .login-container {
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            padding: 48px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin: 20px;
        }

        .login-container h1 {
            margin: 0 0 8px 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.015em;
        }

        .login-container p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0 0 32px 0;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            font-size: 15px;
            font-family: inherit;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .form-group input.is-invalid {
            border-color: var(--error-color);
            background-color: #fff8f8;
        }

        .form-group input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(217, 61, 59, 0.2);
        }

        .error-message {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 12px;
        }

        .submit-btn:hover {
            background-color: var(--primary-hover);
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        .brand-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0071e3 0%, #4facfe 100%);
            border-radius: 16px;
            margin: 0 auto 24px auto;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 113, 227, 0.3);
        }

        .brand-icon svg {
            width: 32px;
            height: 32px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
        </div>
        <h1>Bienvenido</h1>
        <p>Inicia sesión en tu cuenta</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="ejemplo@correo.com" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                @if ($errors->has('email'))
                    <span class="error-message">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required
                    placeholder="••••••••" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                @if ($errors->has('password'))
                    <span class="error-message">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <button type="submit" class="submit-btn" style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                Iniciar Sesión
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>
    </div>
</body>

</html>
