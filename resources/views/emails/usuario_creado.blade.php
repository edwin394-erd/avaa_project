<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a AVAA</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 480px;
            margin: 48px auto;
            padding: 36px 28px 28px 28px;
            border-radius: 14px;
            box-shadow: 0 6px 24px rgba(30,41,59,0.10), 0 1.5px 4px rgba(30,41,59,0.04);
        }
        .header {
            text-align: center;
            margin-bottom: 28px;
        }
        .header img {
            max-width: 110px;
            margin-bottom: 10px;
        }
        .header h2 {
            color: #2563eb;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
        }
        p {
            color: #334155;
            font-size: 1.08em;
            margin: 18px 0 0 0;
            line-height: 1.6;
        }
        .password {
            background: linear-gradient(90deg, #dbeafe 0%, #f1f5f9 100%);
            color: #1e293b;
            font-size: 1.18em;
            padding: 12px 20px;
            border-radius: 8px;
            display: inline-block;
            margin: 14px 0 10px 0;
            letter-spacing: 1.5px;
            font-weight: 600;
            border: 1px dashed #2563eb;
        }
        .footer {
            margin-top: 36px;
            font-size: 0.97em;
            color: #64748b;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 18px;
        }
        @media (max-width: 600px) {
            .container {
                padding: 18px 6vw;
            }
            .header h2 {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- Puedes agregar el logo de AVAA aquí --}}
            {{-- <img src="https://www.programaexcelencia.org/avaa-color.png" alt="AVAA Logo"> --}}
            <h2>¡Bienvenido a AVAA!</h2>
        </div>
        <p>Tu cuenta ha sido creada exitosamente.</p>
        <p>
            Tu contraseña temporal es:
            <span class="password">{{ $password }}</span>
        </p>
        <p>Por favor, cámbiala después de iniciar sesión para mantener tu cuenta segura.</p>
        <div class="footer">
            Si tienes alguna pregunta, contáctanos.<br>
            &copy; {{ date('Y') }} AVAA
        </div>
    </div>
</body>
</html>
